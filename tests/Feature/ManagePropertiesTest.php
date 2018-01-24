<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ManagePropertiesTest extends TestCase
{
	use DatabaseMigrations;

    public function test_an_authorized_person_can_view_listings_page()
    {
        $response = $this->get('/admin/properties');

        $response->assertStatus(200);
    }

    public function test_an_authorized_person_can_view_create_listings_page()
    {
        $response = $this->get('/admin/properties/create');

        $response->assertStatus(200);
    }    

    public function test_an_authorized_person_can_create_property()
    {
    	$response = $this->json('POST', '/admin/properties', [
    		'name' => 'The property name',
            'property_number' => '12345',
    		'reference_number' => 'SAMT-001',
    		'developer' => 'NAKHEEL',
    		'community' => 'Al Furjan',
    		'property_type' => 'VILLA',
            'price' => 3000000,
            'floor' => '708',
    		'bedrooms' => 3,
    		'unit_type' => 'unit type',
    		'size' => 2500,
    		'view' => 'The view',
            'is_rented' => true,
    	]);

    	$this->assertDatabaseHas('properties', [
    		'name' => 'The property name',
            'property_number' => '12345',
    		'reference_number' => 'SAMT-001',
    		'developer' => 'NAKHEEL',
    		'community' => 'Al Furjan',
    		'property_type' => 'VILLA',
            'price' => 3000000,
            'floor' => '708',
    		'bedrooms' => 3,
    		'unit_type' => 'unit type',
    		'size' => 2500,
    		'view' => 'The view',
            'is_rented' => '1',
    	]);
    }

    public function test_an_authorized_person_can_update_property_information()
    {
    	$property = factory(\App\Property::class)->create([
    		'bedrooms' => 2,
    	]);

    	$response = $this->json('PUT', '/admin/properties/1', [
    		'bedrooms' => 3,
    	]);

    	$this->assertDatabaseHas('properties', [
    		'name' => $property->name,
            'reference_number' => $property->reference_number,
    		'property_number' => $property->property_number,
    		'developer' => $property->developer,
    		'community' => $property->community,
            'property_type' => $property->property_type,
    		'price' => $property->price,
    		'bedrooms' => 3,
    		'unit_type' => $property->unit_type,
    		'size' => $property->size,
            'view' => $property->view,
    		'is_rented' => $property->is_rented
    	]);
    }    
}
