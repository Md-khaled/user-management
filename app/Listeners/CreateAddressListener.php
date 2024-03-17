<?php

namespace App\Listeners;

use App\Events\UserAddressCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateAddressListener
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
    public function handle(UserAddressCreated $event): void
    {
        $user = $event->user;
        $addresses = $event->addresses;

        foreach ($addresses as $addressData) {
            $addressData['user_id'] = $user->id;

            $user->addresses()->create($addressData);
        }

    }
}
