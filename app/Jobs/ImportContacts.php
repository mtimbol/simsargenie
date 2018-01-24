<?php

namespace App\Jobs;

use App\Contact;
use App\Events\ContactsWasImported;
use App\Property;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Excel;

class ImportContacts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $file;

    protected $excel;

    protected $skippedContacts = [];

    protected $newContacts = [];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Excel $excel)
    {
        $excel->load(storage_path('app/'.$this->file), function($contacts) {
            $contact_collections = collect($contacts->all())->unique(function($item) {
                return $item['mobile'].$item['property_number'];
            })->values();

            foreach ($contact_collections->chunk(100) as $rows) {
                foreach ($rows as $row) {
                    $mobile = (string) $row->mobile;
                    if ($contact = Contact::whereMobile($mobile)->first()) {
                        $this->skippedContacts[] = $row;
                    } else {
                        $contact = Contact::firstOrCreate([
                            'contact_status' => $row->status ?? null,
                            'client_type' => $row->client_type ?? null,
                            'salutation' => $row->salutation ?? null,
                            'name' => $row->full_name ?? 'N/A',
                            'nationality' => $row->nationality ?? null,
                            'email' => $row->email ?? 'N/A',
                            'mobile' => $row->mobile ?? null,
                            'phone' => $row->phone ?? null,
                            'fax' => $row->fax ?? null,
                            'passport_number' => $row->passport_number ?? null,
                            'source' => $row->database_source ?? null,
                        ]);
                    }

                    if ($property = Property::where('property_number', $row->property_number)->first()) {
                        // Skip
                    } else {
                        $property = Property::create([
                            'property_number' => $row->property_number ?? '',
                            'developer' => $row->developer ?? null,
                            'community' => $row->community ?? null,
                            'name' => $row->subcommunity ?? null,
                            // 'subcommunity' => $row->subcommunity ?? null,
                            'property_type' => $row->property_type ?? null,
                            'size' => $row->property_size ?? null,
                            'property_details_1' => $row->property_details_1 ?? null,
                            'property_details_2' => $row->property_details_2 ?? null,
                        ]);
                    }

                    if (!$contact->properties()->where('property_id', $property->id)->first()) {
                        $contact->properties()->attach($property);
                    }

                    if (!empty($row->notes)) {
                        if ($contact->notes()->whereMessage($row->notes)->count() === 0) {
                            $contact->notes()->create([
                                'user_id' => 1,
                                'message' => $row->notes
                            ]);
                        }
                    }

                    $contact->searchable();
                }
            }
        });

        // event(new ContactsWasImported($this->skippedContacts));
    }
}
