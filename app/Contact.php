<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use Searchable;

    protected $fillable = [
        'contact_status', 'client_type',
    	'salutation', 'name', 'first_name', 'middle_name', 'last_name', 'nationality',
    	'company', 'position',
        'email', 'email2', 'mobile', 'mobile2', 'mobile3', 'phone', 'fax',
        'passport_number', 'id_number',
    	'source', 'notes'
    ];

    public function notes()
    {
        return $this->hasMany(Note::class, 'contact_id');
    }

    public function properties()
    {
        return $this->belongsToMany(Property::class, 'property_contacts');
    }

    public function interestedIn($property)
    {
        return $this->properties()->attach($property);
    }

    public function notInterestedIn($property)
    {
        return $this->properties()->detach($property);
    }

    public static function exists($value)
    {
    	if (str_contains($value, '@')) {
	    	return static::where('email', $value)->count() > 0;
    	}
    	return static::where('phone', $value)->count() > 0;
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->toArray();

        $array['properties'] = $this->properties()->get(['name', 'property_number', 'reference_number', 'developer', 'community', 'property_type', 'bedrooms', 'unit_type']);

        $array['notes'] = $this->notes()->orderByDesc('created_at')->get();

        return $array;
    }    
}
