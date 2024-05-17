<?php

namespace App\Services\User;

use App\Interfaces\User\UserInterface;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Request;

class UserService
{
    protected $userRepository;

//    public function __construct(protected UserInterface $userRepository) {}
    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function userList()
    {
        return $this->userRepository->getUsers();
    }

    public function find($id)
    {
        return $this->userRepository->getUserById($id);
    }

    public function store(array $requet)
    {
        return $this->userRepository->saveUser($requet);
    }

    public function update(int $id, array $requet)
    {
        return $this->userRepository->updateUser($requet, $id);
    }

    public function destroy($id)
    {
        return $this->userRepository->deleteUser($id);
    }

    public function restore($id)
    {
        return $this->userRepository->restore($id);
    }

    public function delete($id)
    {
        return $this->userRepository->forceDelete($id);
    }

    public function listTrashed()
    {
        return $this->userRepository->deleteUserList();
    }

    public function hash($password)
    {
        return $this->userRepository->hash($password);
    }

    public function saveUserBackgroundInfo(User $user)
    {
        return $this->userRepository->saveUserBackgroundInformation($user);
    }

    public function upload(UploadedFile $file, $user)
    {
        return $this->userRepository->upload($file, $user);
    }
}
