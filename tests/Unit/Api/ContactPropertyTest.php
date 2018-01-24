<?php

namespace Tests\Unit\Api;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ContactPropertyTest extends TestCase
{
	use DatabaseMigrations;

    public function test_attach_a_property_on_the_contact()
    {
        $contact = factory(\App\Contact::class)->create();
        $property = factory(\App\Property::class)->create();

        $response = $this->json('POST', '/api/contacts/' . $contact->id . '/properties', [
            'property_id' => $property->id
        ]);

        
        $this->assertDatabaseHas('property_contacts', [
            'contact_id' => 1,
            'property_id' => $property->id
        ]);
    }

    public function test_detach_a_property_from_the_contact()
    {
        $contact = factory(\App\Contact::class)->create();
        $property = factory(\App\Property::class)->create();

        $contact->interestedIn($property);

        $this->assertDatabaseHas('property_contacts', [
            'contact_id' => 1,
            'property_id' => $property->id
        ]);        

        $response = $this->json('DELETE', '/api/contacts/' . $contact->id . '/properties', [
            'property_id' => $property->id
        ]);

        $this->assertDatabaseMissing('property_contacts', [
            'contact_id' => 1,
            'property_id' => $property->id
        ]);     
    }    
}
