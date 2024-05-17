<?php

namespace App\Interfaces\User;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Request;

interface UserInterface
{
    public function getUsers();

    public function getUserById($id);

    public function saveUser(array $data);

    public function updateUser(array $data, int $id);

    public function deleteUser($id);
    public function restore($id);
    public function forceDelete($id);
    public function deleteUserList();
    public function hash($password);
    public function saveUserBackgroundInformation(User $user);
    public function upload(UploadedFile $file, $user);
}
