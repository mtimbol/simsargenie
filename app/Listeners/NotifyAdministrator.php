<?php

namespace App\Listeners;

use App\Events\ContactsWasImported;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyAdministrator
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ContactsWasImported  $event
     * @return void
     */
    public function handle(ContactsWasImported $event)
    {
        // return $event->skipped_contacts;
        return 'hi';
    }
}
