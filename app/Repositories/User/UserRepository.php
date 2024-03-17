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
        $user = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ];

        // return $user;
         
        try {
            DB::beginTransaction();
            // return $request->input('addresses');
            // Create the user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
            ]);
            $user->images()->create(['url' => FileUploadService::uploadFile($request->file('file'))]);
            UserAddressCreated::dispatch($user, $request->input('addresses'));
        
            DB::commit();
        
            return response()->json(['message' => 'User created successfully'], 201);
        } catch (\Exception $e) {
            // Rollback the transaction if an exception occurred
            DB::rollBack();
        
            // Log the error or handle it in any other appropriate way
            Log::error('Error creating user: ' . $e->getMessage());
        
            // Return an error response
            return response()->json(['error' => 'Failed to create user'], 500);
        }
        
        // return User::create($data);
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