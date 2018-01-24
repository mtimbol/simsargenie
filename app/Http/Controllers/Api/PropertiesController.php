<?php

namespace App\Http\Controllers\Api;

use App\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PropertiesController extends Controller
{
    public function index()
    {
    	return Property::orderBy('property_number', 'asc')->get();
    }

    public function show($property)
    {
    	return $property;
    }

    public function update($property, Request $request)
    {
        if ($property->update($request->all())) {
        	return response()->json([
        		'status' => 1,
        		'property' => $property
        	]);
        }

    	return response()->json([
    		'status' => 0,
    		'property' => [] 
    	]);
    }
}
