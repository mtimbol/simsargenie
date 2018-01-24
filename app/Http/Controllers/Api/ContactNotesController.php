<?php

namespace App\Http\Controllers\Api;

use App\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactNotesController extends Controller
{
	public function index(Contact $contact)
	{
		return $contact->notes()->orderBy('created_at', 'desc')->get();
	}

    public function store(Contact $contact, Request $request)
    {
    	$contact->notes()->create([
    		'user_id' => 1, // current user id,
    		'message' => $request->message
    	]);
        
        $contact->searchable();
    }
}
