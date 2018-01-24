<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    protected $fillable = ['name'];

    public function contacts()
    {
    	return $this->belongsToMany(Contact::class, 'community_contacts');
    }
}
