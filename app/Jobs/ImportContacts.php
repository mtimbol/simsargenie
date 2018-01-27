<?php

namespace App\Jobs;

use App\Contact;
use App\Events\ContactsWasImported;
use App\Events\ImportContactsExceptionOccured;
use App\Events\LogSkippedContacts;
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

    protected $import_count = 0;

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
            $this->import_count = 0;
            $this->skippedContacts = [];
            
            $contact_collections = collect($contacts->all())->unique(function($item) {
                return $item['mobile'].$item['property_number'];
            })->values();

            foreach ($contact_collections->chunk(500) as $rows) {
                foreach ($rows as $row) {
                    $mobile = (string) $row->mobile;
                    try {
                        if ($contact = Contact::whereMobile($mobile)->first()) {
                            $this->skippedContacts[] = sprintf('%s, %s, %s', $row->name, $row->email, $row->mobile);
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

                            $this->newContacts[] = sprintf('%s, %s, %s', $contact->name, $contact->email, $contact->mobile);;

                            $this->import_count += 1;
                        }                        
                    } catch (\Exception $e) {
                        // event(new ImportContactsExceptionOccured($e, $row));
                    }

                    try {
                        if ($property = Property::where('property_number', $row->property_number)->first()) {
                            // Skip
                        } else {
                            $property = Property::create([
                                'property_number' => $row->property_number ?? '',
                                'developer' => $row->developer ?? null,
                                'community' => $row->community ?? null,
                                'name' => $row->subcommunity ?? null,
                                'property_type' => $row->property_type ?? null,
                                'size' => $row->property_size ?? null,
                                'property_details_1' => $row->property_details_1 ?? null,
                                'property_details_2' => $row->property_details_2 ?? null,
                            ]);
                        }                        
                    } catch (\Exception $e) {
                        // event(new ImportContactsExceptionOccured($e, $row));
                    }

                    try {                        
                        if (!$contact->properties()->where('property_id', $property->id)->first()) {
                            $contact->properties()->attach($property);
                        }
                    } catch (\Exception $e) {
                        // event(new ImportContactsExceptionOccured($e, $contact));
                    }

                    if (!empty($row->notes)) {
                        try {                        
                            if ($contact->notes()->whereMessage($row->notes)->count() === 0) {
                                $contact->notes()->create([
                                    'user_id' => 1,
                                    'message' => $row->notes
                                ]);
                            }
                        } catch (\Exception $e) {
                            // event(new ImportContactsExceptionOccured($e, $row->notes));
                        }
                    }

                    $contact->searchable();
                }
            }

            $message = sprintf('You have successfully imported %s new contacts.', $this->import_count);
            event( new ContactsWasImported($message));

            $message = sprintf("%s contacts we're skipped because they're already existing in your database or might be a duplicate records on your CSV file.", count($this->skippedContacts));
            event(new LogSkippedContacts($message));
        });
    }
}
