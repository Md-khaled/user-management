<?php

namespace App\Traits;

use App\Models\User;

trait CreateDummyUser
{
    public function createUser($NumberOfUser = null, $data = [])
    {
        return User::factory($NumberOfUser)->create($data);
    }

    public function createSoftDeleteUser($NumberOfUser = null)
    {
        return $this->createUser($NumberOfUser, ['deleted_at' => now()]);
    }
}
