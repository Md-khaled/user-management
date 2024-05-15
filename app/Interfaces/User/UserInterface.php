<?php

namespace App\Interfaces\User;

use App\Models\User;
use Illuminate\Support\Facades\Request;

interface UserInterface
{
    public function getUsers();

    public function getUserById($id);

    public function saveUser($data);

    public function updateUser($data, $id);

    public function deleteUser($id);
    public function restore($id);
    public function forceDelete($id);
    public function deleteUserList();
    public function hash($password);
    public function saveUserBackgroundInformation(User $user);
}
