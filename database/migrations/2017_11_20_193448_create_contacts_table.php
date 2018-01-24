<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('contact_status')->nullable();
            $table->string('client_type')->nullable();
            // Personal information
            $table->string('salutation')->nullable();
            $table->string('name');
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('nationality')->nullable();
            // Company information
            $table->string('company')->nullable();
            $table->string('position')->nullable();
            // Contact information
            $table->string('email');
            $table->string('email2')->nullable();
            $table->string('mobile')->nullable();
            $table->string('mobile2')->nullable();
            $table->string('mobile3')->nullable();
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
            // Other contact information
            $table->string('passport_number')->nullable();
            // $table->date('passport_expiry')->nullable();
            $table->string('id_number')->nullable();
            // $table->date('id_expiry')->nullable();
            // $table->date('birthdate')->nullable();
            $table->string('source')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
