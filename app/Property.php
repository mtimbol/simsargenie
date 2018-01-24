<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = [
    	'name', 'property_number', 'reference_number', 'developer', 'community',
    	'property_type', 'bedrooms', 'unit_type', 'price', 'floor', 'size', 'view', 'is_rented',
    	'property_details_1', 'property_details_2'
    ];

    public function contacts()
    {
        return $this->belongsToMany(Contact::class, 'property_contacts');
    }    
}
