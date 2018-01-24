<?php

namespace App\Http\Controllers\Api;

use App\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactPropertiesController extends Controller
{
    public function index(Contact $contact)
    {
        return $contact->properties->unique();
    }

    public function store(Request $request, Contact $contact)
    {
    	if ($request->has('property_id')) {		
	    	return $contact->interestedIn([
	    		'property_id' => $request->property_id
	    	]);
    	}

    	return response()->json([
    		'status' => 0,
    		'message' => 'Oops. You did not pass a property to attach.'
    	]);
    }

    public function destroy(Request $request, Contact $contact)
    {
        if ($request->has('property_id')) {     
            return $contact->notInterestedIn([
                'property_id' => $request->property_id
            ]);
        }

        return response()->json([
            'status' => 0,
            'message' => 'Oops. You did not pass a property to attach.'
        ]);
    }    
}
