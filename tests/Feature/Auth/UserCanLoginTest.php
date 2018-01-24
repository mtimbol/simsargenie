<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserCanLoginTest extends TestCase
{
	use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_a_user_can_login_on_the_website()
    {
        factory(\App\User::class)->create([
            'email' => 'mark@timbol.com',
            'password' => 'marktimbol'
        ]);

    	$response = $this->json('POST', '/login', [
    		'email' => 'mark@timbol.com',
    		'password' => 'marktimbol',
    	]);

    	$this->isAuthenticated();
    }
}
