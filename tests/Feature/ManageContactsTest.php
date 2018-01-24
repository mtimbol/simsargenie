<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ManageContactsTest extends TestCase
{
	use DatabaseMigrations;

    public function test_an_authorized_user_can_create_a_new_contact()
    {
        // TODO: User should be authorized to process this request.
        $property = factory(\App\Property::class)->create();
        $property2 = factory(\App\Property::class)->create();

        $response = $this->json('POST', '/admin/contacts', [        
            'contact_status' => 'lead',
            'client_type' => 'landlord',
            // Personal Information
            'salutation' => 'MR.',
            'name' => 'Mark Timbol',
            // 'first_name' => 'Mark',
            // 'middle_name' => 'Turla',
            // 'last_name' => 'Timbol',
            'nationality' => 'Filipino',

            // Company Information
            'company' => 'Belpro Digital',
            'position' => 'Web Developer',
            
            // Contact information
            'email' => 'mark@timbol.com',
            'email2' => 'mark2@timbol.com',
            'mobile' => '+971 56 820 7181',
            'mobile2' => '+971 56 820 7182',
            'mobile3' => '+971 56 820 7183',
            'phone' => '+971 4 820 7189',

            // Other contact information
            'passport_number' => 'EB6159498',
            // '_passport_expiry' => = '', 
            'id_number' => '12345',
            // 'id_expiry' => '',
            // 'birth_date' => = '', 
            'source' => 'propertyfinder',
            'properties' => [$property->id, $property2->id]
        ]);
        
        $this->assertDatabaseHas('contacts', [
            'contact_status' => 'lead',
            'client_type' => 'landlord',
            // Personal Information
            'salutation' => 'MR.',
            'name' => 'Mark Timbol',
            // 'first_name' => 'Mark',
            // 'middle_name' => 'Turla',
            // 'last_name' => 'Timbol',
            'nationality' => 'Filipino',

            // Company Information
            'company' => 'Belpro Digital',
            'position' => 'Web Developer',
            
            // Contact information
            'email' => 'mark@timbol.com',
            'email2' => 'mark2@timbol.com',
            'mobile' => '+971 56 820 7181',
            'mobile2' => '+971 56 820 7182',
            'mobile3' => '+971 56 820 7183',
            'phone' => '+971 4 820 7189',

            // Other contact information
            'passport_number' => 'EB6159498',
            // 'passport_expiry' => = '', 
            'id_number' => '12345',
            // _'id_expiry' => '',
            // '_birth_date' => = '', 
            'source' => 'propertyfinder',
        ]);

        $this->assertDatabaseHas('property_contacts', [
            'contact_id' => 1,
            'property_id' => $property->id,
        ]);

        $this->assertDatabaseHas('property_contacts', [
            'contact_id' => 1,
            'property_id' => $property2->id,
        ]);        
    }

    public function test_an_authorized_user_can_update_any_contact_information()
    {
    	// TODO: User should be authorized to process this request.
    	$contact = factory(\App\Contact::class)->create([
    		'email' => 'mark@timbol.com',
    		'client_type' => 'buyer',
    	]);

    	// PUT request to update contact status only
    	$response = $this->json('PUT', '/admin/contacts/1', [
    		'contact_status' => 'LEAD',
    	]);

    	$this->assertDatabaseHas('contacts', [
    		'email' => 'mark@timbol.com',
    		'contact_status' => 'LEAD'
    	]);     	

    	// PUT request to update mobile only
    	$this->json('PUT', '/admin/contacts/1', [
    		'mobile' => '+971 56 820 7189',
    	]);

    	$this->assertDatabaseHas('contacts', [
    		'email' => 'mark@timbol.com',
    		'mobile' => '+971 56 820 7189'
    	]); 

    	// PUT request to update notes only
    	$response = $this->json('PUT', '/admin/contacts/1', [
    		'notes' => 'A sample note',
    	]);

    	$this->assertDatabaseHas('contacts', [
    		'email' => 'mark@timbol.com',
    		'notes' => 'A sample note'
    	]);   	
    }
}
