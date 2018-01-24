<?php

namespace App\Http\Controllers\Admin;

use App\Contact;
use App\Http\Controllers\Controller;
use App\Jobs\ImportContacts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Excel;

class ImportContactsController extends Controller
{
    protected $skippedContacts = [];
    protected $newContacts = [];

	public function index()
	{
		return view('admin.contacts.import.index');
	}

    public function store(Request $request, Excel $excel)
    {
    	$this->validate($request, [
    		'csv' => 'required'
    	]);

        $file = $request->file('csv')->store('imports');
        
        dispatch(new ImportContacts($file));
    }
}
