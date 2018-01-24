<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ContactTest extends TestCase
{
	use DatabaseMigrations;

    public function test_contact_is_interested_in_selected_properties()
    {
        $property = factory(\App\Property::class)->create();
        $property2 = factory(\App\Property::class)->create();
        $contact = factory(\App\Contact::class)->create();

        $contact->interestedIn([$property->id, $property2->id]);

        $this->assertDatabaseHas('property_contacts', [
            'contact_id' => 1,
            'property_id' => $property->id
        ]);

        $this->assertDatabaseHas('property_contacts', [
            'contact_id' => 1,
            'property_id' => $property2->id
        ]);        
    }
}
