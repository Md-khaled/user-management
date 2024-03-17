<?php

namespace App\Listeners;

use App\Events\UserAddressRetrieved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RetrieveAddressListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserAddressRetrieved $event): void
    {
        $user = $event->user;
        $user->load('addresses');

    }
}
