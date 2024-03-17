<?php

namespace App\Listeners;

use App\Events\UserAddressDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DeleteAddressListener
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
    public function handle(UserAddressDeleted $event): void
    {
        $user = $event->user;
        $user->addresses()->delete();

    }
}
