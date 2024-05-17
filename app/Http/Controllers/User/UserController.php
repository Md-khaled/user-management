<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use App\Models\User;
use App\Services\User\UserService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;

class UserController extends Controller
{
    protected $userService;

    /**
     * Create a new constructor for this controller
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $users = $this->userService->userList();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $registerUserRequest)
    {
        $this->userService->store($registerUserRequest);
        return redirect()->back()->with('success', 'User data stored successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $updateRequest, $id)
    {
        $this->userService->update($updateRequest, $id);
        return redirect()->back()->with('success', 'User data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->userService->destroy($id);
        return to_route('users.index');
    }

    public function trashed()
    {
        $deletedUsers = $this->userService->listTrashed();
        return view('users.deleted-list', compact('deletedUsers'));
    }
    public function restore(int $id)
    {
        $this->userService->restore($id);
        return back();
    }
    public function delete(int $id)
    {
        $this->userService->delete($id);
        return back();
    }
}
