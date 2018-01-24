<?php

namespace Tests\Unit;

use App\Contact;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CheckContactExistenceTest extends TestCase
{
	use DatabaseMigrations;

    public function test_if_contact_is_existing_by_entering_the_email_address()
    {
        factory(Contact::class)->create([
        	'email' => 'john@example.com',
        ]);

        factory(Contact::class)->create([
        	'phone' => '+971 56 820 7189',
        ]);

        $this->assertTrue(Contact::exists('john@example.com'));
        $this->assertFalse(Contact::exists('jane@example.com'));

        $this->assertTrue(Contact::exists('+971 56 820 7189'));
        $this->assertFalse(Contact::exists('+971 56 000 0000'));
    }
}
