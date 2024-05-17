<?php

namespace Tests\Unit\User;

use App\Interfaces\User\UserInterface;
use App\Models\User;
use App\Services\User\UserService;
use App\Traits\CreateDummyUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Pagination\LengthAwarePaginator;
use Tests\TestCase;

class SaveUserBackgroundInformationTest extends TestCase
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

    public function test_it_can_return_a_paginated_list_of_users()
    {
        $user = $this->createUser();
        $this->userRepositoryMock->expects($this->once())
            ->method('saveUserBackgroundInformation')
            ->with($user->id)
            ->willReturn($user);
       $this->assertTrue(true);
    }
}
