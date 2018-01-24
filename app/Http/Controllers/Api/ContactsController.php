<?php

namespace App\Http\Controllers\Api;

use App\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    public function index()
    {
    	// return Contact::with('properties')->orderBy('name', 'asc')->get();
		return Contact::with(['properties' => function($query) {
			$query->count() ? $query->get(['community', 'name', 'property_number']) : $query;
		}])->orderBy('name', 'asc')->get();
    }

    public function update($contact, Request $request)
    {
    	if ($contact->update(['contact_status' => $request->contact_status])) {
    		return response()->json([
    			'status' => 1,
    			'contact' => 'Contact status has been successfully updated.'
    		]);
    	}

    	return response()->json([
    		'status' => 0,
    		'message' => 'Oops. Something went wrong. Please try again.'
    	]);
    }
}
