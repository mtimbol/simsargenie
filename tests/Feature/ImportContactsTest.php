<?php

namespace Feature;

use App\Events\ContactsWasImported;
use App\Jobs\ImportContacts;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ImportContactsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        $user = factory(\App\User::class)->create();
        $this->actingAs($user);
    }

    public function test_importing_contacts_should_fire_an_import_contact_job()
    {
        $this->expectsJobs(ImportContacts::class);

        $response = $this->json('POST', '/admin/contacts/import', [
            'csv' => 'import/contacts.csv'
        ]);

        // $response->dump();
    }

    public function test_it_fires_an_event_when_the_importing_of_contacts_is_finished()
    {
        $this->expectsEvents(ContactsWasImported::class);

        $response = $this->json('POST', '/admin/contacts/import', [
            'csv' => 'import/contacts.csv'
        ]);

        // $response->dump();
    }

    public function test_an_admin_can_upload_contacts_in_a_csv_file()
    {
        // TODO
        // User should be logged-in.
        // User should have a permission to import contacts.

        $response = $this->json('POST', '/admin/contacts/import', [
            'csv' => new UploadedFile(public_path('import/contacts.csv'), 'contacts.csv', null, null, null, true)
        ]);

        // $response->assertStatus(200);
        $this->assertDatabaseHas('contacts', [
            'id' => 1,
            'client_type' => 'LANDLORD',
            'salutation' => 'Mr.',
            'name' => 'Mark Timbol',
            'email' => 'mark@timbol.com',
            'mobile' => '971568207189',
        ]);

        $this->assertDatabaseHas('properties', [
            'id' => 1,
            // 'name' => null,
            'property_number' => 'J-316',
            'developer' => 'EMAAR',
            'community' => 'RM2 Mira Oasis',
        ]);

        $this->assertDatabaseHas('property_contacts', [
            'property_id' => 1,
            'contact_id' => 1,
        ]);
    }

    public function test_skip_contacts_that_are_already_saved_in_the_database()
    {
        factory(\App\Contact::class)->create([
            'email' => 'mark@timbol.com',
        ]);

        $this->assertDatabaseHas('contacts', [
            'email' => 'mark@timbol.com' // Existing email in the CSV file
        ]);

        $response = $this->JSON('POST', '/admin/contacts/import', [
            'csv' => '/import/contacts.csv'
        ]);

        // $response->dump();
        $response->assertStatus(200);
    }
}
