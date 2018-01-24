<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Contact::class, function (Faker\Generator $faker) {
    return [
        'contact_status' => 'lead',
        'client_type' => 'landlord',
        // Personal information
        'salutation' => $faker->title,
        'name' => $faker->name,
        'first_name' => $faker->firstName,
        'middle_name' => '',
        'last_name' => $faker->lastName,
        'nationality' => $faker->country,
        // Company information
        'company' => $faker->company,
        'position' => $faker->jobTitle,
        // Contact information
        'email' => $faker->unique()->safeEmail,
        'email2' => $faker->unique()->safeEmail,
        'mobile' => $faker->phoneNumber,
        'mobile2' => $faker->phoneNumber,
        'mobile3' => $faker->phoneNumber,
        'phone' => $faker->phoneNumber,
        'fax' => $faker->phoneNumber,
        // Other contact information
        'passport_number' => $faker->randomNumber,
        'id_number' => $faker->randomNumber,
        'source' => 'propertyfinder',
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Property::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'reference_number' => 'SAMT-001',
        'property_number' => $faker->randomNumber,
        'developer' => $faker->sentence,
        'community' => $faker->city,
        'property_type' => 'VILLA',
        'price' => $faker->randomNumber,
        'bedrooms' => 3,
        'unit_type' => 'VILLA',
        'size' => 2500,
        'view' => $faker->paragraph,
        'is_rented' => $faker->boolean,
    ];
});
