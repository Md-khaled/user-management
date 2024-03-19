<?php

namespace App\Repositories\User;

use App\Events\UserAddressCreated;
use App\Interfaces\User\UserInterface;
use App\Models\User;
use App\Services\FileUploadService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

class UserRepository implements UserInterface
{
    public function getUsers()
    {
        return User::all();
    }

    public function saveUser($request)
    {
        try {
            DB::beginTransaction();

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
            ]);

            FileUploadService::uploadFile($request->file, $user);
            if ($request->has('addresses')) {
                UserAddressCreated::dispatch($user, $request->input('addresses'));
            }
        
            DB::commit();
        
            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating user: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to create user'], 500);
        }
    }

    public function updateUser($id, array $data)
    {
        $user = User::findOrFail($id);
        $user->update($data);
        return $user;
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    }

    public function getUserById($id)
    {
        return User::findOrFail($id);
    }
}