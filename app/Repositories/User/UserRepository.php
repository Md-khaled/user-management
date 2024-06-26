<?php

namespace App\Repositories\User;

use App\Events\UserAddressCreated;
use App\Events\UserAddressUpdated;
use App\Interfaces\User\UserInterface;
use App\Models\Detail;
use App\Models\User;
use App\Services\FileUploadService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

class UserRepository implements UserInterface
{
    const PER_PAGE = 10;

    public function getUsers()
    {
        return User::paginate(self::PER_PAGE);
    }

    public function saveUser(array $request)
    {
        try {
            DB::beginTransaction();

            $user = User::create([
                'prefixname' => $request['prefixname'],
                'firstname' => $request['firstname'],
                'middlename' => $request['middlename'],
                'lastname' => $request['lastname'],
                'suffixname' => $request['suffixname'],
                'username' => $request['username'],
                'email' => $request['email'],
                'password' => $this->hash($request['password']),
                'type' => $request['type'],
            ]);

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
            $user->update($request);

            DB::commit();

            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating user: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to update user'], 500);
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

    public function upload(UploadedFile $file, $user)
    {
        FileUploadService::uploadFile($file, $user);
    }

    public function saveUserBackgroundInformation(User $user)
    {
        $details = [
            ['key' => 'full_name', 'value' => $this->getFullName($user)],
            ['key' => 'middle_initial', 'value' => $this->getMiddleInitial($user)],
            ['key' => 'avatar', 'value' => $this->getAvatar($user)],
            ['key' => 'gender', 'value' => $this->getGender($user)]
        ];

        foreach ($details as $detail) {
            Detail::updateOrCreate(
                ['user_id' => $user->id, 'key' => $detail['key']],
                ['value' => $detail['value'], 'type' => 'detail']
            );
        }
    }

    protected function getFullName(User $user): string
    {
        return "{$user->firstname} {$user->middlename} {$user->lastname}";
    }

    protected function getMiddleInitial(User $user): string
    {
        return strtoupper(substr($user->middlename, 0, 1) . '.');
    }

    protected function getAvatar(User $user): string
    {
        return $user->photo ?? 'default-avatar.jpg';
    }

    protected function getGender(User $user): string
    {
        return $user->prefixname === 'Mr' ? 'Male' : ($user->prefixname === 'Mrs' ? 'Female' : 'Other');
    }
}
