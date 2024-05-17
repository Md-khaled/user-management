<?php

namespace Tests\Unit\User;

use App\Interfaces\User\UserInterface;
use App\Models\Image;
use App\Models\User;
use App\Services\User\UserService;
use App\Traits\CreateDummyUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware, CreateDummyUser;

    const USER_COUNT = 10;
    const CURRENT_PAGE = 1;

    protected $userService;
    protected $userRepositoryMock;
    private $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->userRepositoryMock = $this->createMock(UserInterface::class);
        $this->userService = new UserService($this->userRepositoryMock);
    }

    /*public function test_it_can_return_a_paginated_list_of_users()
    {
        // Mock UserInterface
        $userMock = \Mockery::mock(UserInterface::class);
        $userMock->shouldReceive('getUsers')
            ->once()
            ->andReturn(new \Illuminate\Pagination\LengthAwarePaginator([], 10, 1, 1));
        $userService = new UserService($userMock);
        $users = $userService->all();
        // Assert the result
        $this->assertInstanceOf(\Illuminate\Pagination\LengthAwarePaginator::class, $users);
    }*/

    public function test_it_can_return_a_paginated_list_of_users()
    {
        $users = $this->createUser(self::USER_COUNT);
        $paginator = new LengthAwarePaginator($users, count($users), self::USER_COUNT, self::CURRENT_PAGE);
        $this->userRepositoryMock
            ->method('getUsers')
            ->willReturn($paginator);

        $result = $this->userService->userList();
        $this->assertInstanceOf(LengthAwarePaginator::class, $result);
    }

    public function test_it_can_store_a_user_to_database()
    {
        $userData = [
            'prefixname' => 'Mr',
            'firstname' => 'John',
            'middlename' => 'Doe',
            'lastname' => 'Smith',
            'suffixname' => 'Jr',
            'username' => 'johndoe',
            'email' => 'john@example.com',
            'password' => 'password123',
        ];
        $user = new User($userData);

        $this->userRepositoryMock->expects($this->once())
            ->method('saveUser')
            ->with($userData)
            ->willReturn($user);

        $result = $this->userService->store($userData);
        $this->assertInstanceOf(User::class, $result);
        $this->assertEquals($userData['email'], $result->email);
    }

    public function test_it_can_find_and_return_an_existing_user()
    {
        $user = $this->createUser();

        $this->userRepositoryMock->expects($this->once())
            ->method('getUserById')
            ->with($user->id)
            ->willReturn($user);

        $result = $this->userService->find($user->id);
        $this->assertInstanceOf(User::class, $result);
        $this->assertEquals($user->username, $result->username);
    }

    public function test_it_can_update_an_existing_user()
    {
        $user = $this->createUser();
        $updatedData = [
            'firstname' => 'UpdatedFirstName',
            'lastname' => 'UpdatedLastName',
        ];

        $this->userRepositoryMock->expects($this->once())
            ->method('updateUser')
            ->with($updatedData, $user->id)
            ->willReturn($user->update($updatedData));

        $result = $this->userService->update($user->id, $updatedData);
        $this->assertTrue($result);
    }

    public function test_it_can_soft_delete_an_existing_user()
    {
        $user = $this->createUser();

        $this->userRepositoryMock->expects($this->once())
            ->method('deleteUser')
            ->with($user->id);

        $this->userService->destroy($user->id);
    }

    public function test_it_can_return_a_paginated_list_of_trashed_users()
    {
        $trashedUsers = $this->createSoftDeleteUser(self::USER_COUNT);

        $paginator = new LengthAwarePaginator($trashedUsers, count($trashedUsers), self::USER_COUNT, self::CURRENT_PAGE);
        $this->userRepositoryMock->expects($this->once())
            ->method('deleteUserList')
            ->willReturn($paginator);
        $result = $this->userService->listTrashed();

        $this->assertInstanceOf(LengthAwarePaginator::class, $result);
    }

    public function test_it_can_restore_a_soft_deleted_user()
    {
        $trashedUser = $this->createSoftDeleteUser();

        $this->userRepositoryMock->expects($this->once())
            ->method('restore')
            ->with($trashedUser->id)
            ->willReturn(true);
        $result = $this->userService->restore($trashedUser->id);

        $this->assertTrue($result);
    }

    public function test_it_can_permanently_delete_a_soft_deleted_user()
    {
        $trashedUser = $this->createSoftDeleteUser();

        $this->userRepositoryMock->expects($this->once())
            ->method('forceDelete')
            ->with($trashedUser->id);

        $this->userService->delete($trashedUser->id);
    }

    public function test_it_can_upload_photo()
    {
        $user = $this->createUser();
        Storage::fake('public');
        $file = UploadedFile::fake()->image('uploaded_photo.jpg');

        $this->userRepositoryMock->expects($this->once())
            ->method('upload')
            ->with($file, $user)
            ->willReturn(Image::STORAGE_PATH . '/uploaded_photo.jpg');
        $result = $this->userService->upload($file, $user);

        $this->assertEquals(Image::STORAGE_PATH . '/uploaded_photo.jpg', $result);
    }
}
