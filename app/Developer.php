<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    protected $fillable = ['name'];

    public function contacts()
    {
    	return $this->belongsToMany('App\Contact', 'developer_contacts');
    }
}
