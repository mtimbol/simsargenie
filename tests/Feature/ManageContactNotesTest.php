<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ManageContactNotesTest extends TestCase
{
	use DatabaseMigrations;

    public function test_an_authorized_user_can_create_a_note_for_contact()
    {
		$user = factory(\App\User::class)->create();
		$contact = factory(\App\Contact::class)->create();

		$response = $this->post('/api/contacts/1/notes', [
			'message' => 'This is a note'
		]);

		$this->assertDatabaseHas('notes', [
			'user_id' => $user->id,
			'contact_id' => $contact->id,
			'message' => 'This is a note'
		]);
    }
}
