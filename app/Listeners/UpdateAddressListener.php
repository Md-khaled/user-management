<?php

namespace App\Listeners;

use App\Events\UserAddressUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateAddressListener
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
    public function handle(UserAddressUpdated $event): void
    {
        $user = $event->user;
        $addresses = $event->addresses;

        $user->addresses()->delete();

        foreach ($addresses as $addressData) {
            $user->addresses()->create($addressData);
        }

    }
}
