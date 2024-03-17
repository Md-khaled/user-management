<?php

namespace App\Services\User;

use App\Interfaces\User\UserInterface;
use Illuminate\Support\Facades\Request;

class UserService
{
    // protected $userRepository;
    public function __construct(protected UserInterface $userRepository) {}
    // public function __construct(UserInterface $userRepository) {
    //     $this->userRepository = $userRepository;
    // }

    public function all()
    {
        return $this->userRepository->getUsers();
    }

    public function find($id)
    {
        return $this->userRepository->getUserById($id);
    }
    
    public function create($requet)
    {
        return $this->userRepository->saveUser($requet);
    }

    public function update(array $data, $id)
    {
        return $this->userRepository->updateUser($data, $id);
    }
    
    public function delete($id)
    {
        return $this->userRepository->deleteUser($id);
    }   
}