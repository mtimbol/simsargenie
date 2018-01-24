<?php

namespace App\Http\Controllers\Admin;

use App\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PropertiesController extends Controller
{
    public function index()
    {
        $alertTitle = 'Properties';
        $properties = Property::orderBy('name', 'ASC')->get();
        return view('admin.properties.index', compact('alertTitle', 'properties'));
    }

    public function create()
    {
        return view('admin.properties.create');
    }

    public function store(Request $request)
    {        
        // dd($request->all());
        $this->validate($request, [
            'property_number' => 'required',
            'name' => 'required'
        ]);

    	if (Property::create($request->all())) {
            flash(sprintf('%s has been successfully created.', $request->name))->success();
        } else {
            flash(sprintf('Oops. Something went wrong while creating %s.', $request->name))->error();
        }

        return redirect()->route('admin.properties.index');
    }

    public function edit(Property $property)
    {
        return view('admin.properties.edit', compact('property'));
    }

    public function update(Request $request, Property $property)
    {
        // $this->validate($request, [
        //     'property_number' => 'required',
        //     'name' => 'required'
        // ]);    	

        if ($property->update($request->all())) {
            flash(sprintf('%s has been successfully updated.', $property->name))->success();
        } else {
            flash(sprintf('Oops. Something went wrong while creating %s.', $property->name))->error();
        }

        return redirect()->route('admin.properties.edit', $property->id);
    }    
}
