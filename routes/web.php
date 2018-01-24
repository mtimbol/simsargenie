<?php

use App\Contact;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'Auth\LoginController@showLoginForm');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth'], function() {
	Route::get('/', 'Admin\AdminController@index')->name('index');

	// Import Contacts
	Route::get('contacts/import', 'Admin\ImportContactsController@index')->name('contacts.import.index');
	Route::post('contacts/import', 'Admin\ImportContactsController@store');
	Route::put('contacts/import/update-skipped', 'Admin\UpdateSkippedContactsController@update');

	// ContactsController
	Route::get('contacts', 'Admin\ContactsController@index')->name('contacts.index');
	Route::get('contacts/create', 'Admin\ContactsController@create')->name('contacts.create');
	Route::get('contacts/{contact}', 'Admin\ContactsController@show')->name('contacts.show');
	Route::post('contacts', 'Admin\ContactsController@store');
	Route::put('contacts/{contact}', 'Admin\ContactsController@update');
	
	Route::get('leads/{lead?}', 'Admin\LeadsController@index')->name('leads.index');

	Route::resource('properties', 'Admin\PropertiesController');
	// Route::get('properties', 'Admin\PropertiesController@index')->name('admin.properties.index');
	// Route::get('properties/create', 'Admin\PropertiesController@create')->name('admin.properties.create');
	// Route::post('properties', 'Admin\PropertiesController@store')->name('admin.properties.store');
	// Route::get('properties/edit/{property}', 'Admin\PropertiesController@edit')->name('admin.properties.edit');
	// Route::put('properties/{property}', 'Admin\PropertiesController@update')->name('admin.properties.update');
});

Auth::routes();
Route::get('/home', 'Admin\AdminController@index');
