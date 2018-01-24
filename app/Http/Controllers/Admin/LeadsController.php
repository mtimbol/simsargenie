<?php

namespace App\Http\Controllers\Admin;

use JavaScript;
use App\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LeadsController extends Controller
{
	public function index($lead = 'all')
	{
		// dd($lead);

		if ($lead === 'all') {
			$contacts = Contact::with(['properties' => function($query) {
				$query->get(['community', 'name', 'property_number']);
				}])->where('contact_status', '!=', '')
				->orderBy('name', 'asc')
				->get();
		} else {		
			$contacts = Contact::with(['properties' => function($query) {
				$query->get(['community', 'name', 'property_number']);
				}])->where('contact_status', $lead)
				->orderBy('name', 'asc')
				->get();
		}


	    JavaScript::put([
	        'contacts' => $contacts,
	    ]);	

	    $leadsBy = ucfirst($lead);
		return view('admin.leads.index', compact('leadsBy'));
	}
}
