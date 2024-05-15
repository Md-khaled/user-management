<?php

namespace App\Repositories\User;

use App\Events\UserAddressCreated;
use App\Events\UserAddressUpdated;
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
                'prefixname' => $request->prefixname,
                'firstname' => $request->firstname,
                'middlename' => $request->middlename,
                'lastname' => $request->lastname,
                'suffixname' => $request->suffixname,
                'username' => $request->username,
                'email' => $request->email,
                'password' => $this->hash($request->password),
                'type' => $request->type,
            ]);

            if ($request->has('photo')) {
                FileUploadService::uploadFile($request->photo, $user);
            }

            DB::commit();

            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating user: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to create user'], 500);
        }
    }

    public function updateUser($request, $id)
    {
        try {
            DB::beginTransaction();

            $user = User::findOrFail($id);
            $user->update($request->only([
                'prefixname',
                'firstname',
                'middlename',
                'lastname',
                'suffixname',
                'username',
                'email',
                'type',
            ]));

            if ($request->has('photo')) {
                FileUploadService::uploadFile($request->photo, $user);
            }

            DB::commit();

            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating user: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to create user'], 500);
        }
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
    public function deleteUserList()
    {
        return User::onlyTrashed()->get();

    }
    public function restore($id)
    {
        $user = User::withTrashed()->find($id);
        return $user->restore();
    }
    public function forceDelete($id)
    {
        $user = User::onlyTrashed()->find($id);
        if ($user) {
            $user->forceDelete();
        }
    }

    public function hash($password)
    {
        return Hash::make($password);
    }
}
