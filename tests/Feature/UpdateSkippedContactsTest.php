<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UpdateSkippedContactsTest extends TestCase
{
	use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_update_skipped_contacts_from_import()
    {
    	$skipped_contacts = [];

        factory(\App\Contact::class)->create([
        	'salutation' => 'MR',
            'email' => 'a.cherkaoui@gmail.com', // Existing email in the CSV file
        ]);

        $skipped_contacts[] = factory(\App\Contact::class)->make([
        	'email' => 'a.cherkaoui@gmail.com',
        	'salutation' => 'MS'
        ]);

        $response = $this->JSON('PUT', '/admin/contacts/import/update-skipped', [
        	'contacts' => $skipped_contacts
        ]);
        
        $this->assertDatabaseHas('contacts', [
        	'email' => 'a.cherkaoui@gmail.com',
        	'salutation' => 'MS'	
        ]);
    }
}
