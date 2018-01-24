<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('contacts', 'Api\ContactsController@index');
Route::put('contacts/{contact}', 'Api\ContactsController@update');
Route::get('properties', 'Api\PropertiesController@index');
Route::get('properties/{property}', 'Api\PropertiesController@show');
Route::put('properties/{property}', 'Api\PropertiesController@update');
Route::get('contacts/{contact}/properties', 'Api\ContactPropertiesController@index');
Route::post('contacts/{contact}/properties', 'Api\ContactPropertiesController@store');
Route::delete('contacts/{contact}/properties', 'Api\ContactPropertiesController@destroy');
Route::get('contacts/{contact}/notes', 'Api\ContactNotesController@index');
Route::post('contacts/{contact}/notes', 'Api\ContactNotesController@store');
