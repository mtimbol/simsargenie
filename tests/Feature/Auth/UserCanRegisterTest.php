<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserCanRegisterTest extends TestCase
{
	use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_a_user_can_register_on_the_website()
    {
    	$response = $this->json('POST', '/register', [
    		'name' => 'Mark Timbol',
    		'email' => 'mark@timbol.com',
    		'password' => 'marktimbol',
    		'password_confirmation' => 'marktimbol'
    	]);

    	$this->assertDatabaseHas('users', [
    		'name' => 'Mark Timbol',
    		'email' => 'mark@timbol.com'
    	]);

    	$this->isAuthenticated();
    }
}
