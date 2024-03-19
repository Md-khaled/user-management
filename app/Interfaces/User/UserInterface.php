<?php

namespace App\Interfaces\User;

use Illuminate\Support\Facades\Request;

interface UserInterface
{
    public function getUsers();

    public function getUserById($id);

    public function saveUser($data);

    public function updateUser($data, $id);

    public function deleteUser($id);
}
