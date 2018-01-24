<?php

namespace App\Http\Controllers\Admin;

use JavaScript;
use App\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactsController extends Controller
{
	public function index()
	{
	    JavaScript::put([
	        'algolia_app_id' => config('scout.algolia.id'),
	        'algolia_app_key' => config('scout.algolia.key'),
	        'algolia_contacts_index' => config('scout.algolia.contacts_index'),
	    ]);
		
		$total_contacts = Contact::count();
		return view('admin.contacts.index', compact('total_contacts'));
	}

	public function show($contact)
	{
		return view('admin.contacts.show', compact('contact'));
	}

	public function create()
	{
		return view('admin.contacts.create');
	}

	public function store(Request $request)
	{
		$this->validate($request, [
			'name' => 'required',
			'phone' => 'required'
		]);
		
		$contact = Contact::create($request->all());

		if ($request->has('properties')) {
			$contact->interestedIn($request->properties);
		}
	}

    public function update(Request $request, Contact $contact)
    {
    	// TODO: Validate request
    	if ($contact->update($request->all()))
    	{
    		$contact->searchable();
    		return response()->json([
    			'status' => 1,
    			'contact' => 'Contact has been successfully updated.'
    		]);
    	}

    	return response()->json([
    		'status' => 0,
    		'message' => 'Oops. Something went wrong. Please try again.'
    	]);
    }
}
