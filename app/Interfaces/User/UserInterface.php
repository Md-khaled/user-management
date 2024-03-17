<?php

namespace App\Interfaces\User;

use Illuminate\Support\Facades\Request;

interface UserInterface
{
    public function getUsers();

    public function getUserById($id);

    public function saveUser($data);

    public function updateUser($id, array $data);

    public function deleteUser($id);
}
