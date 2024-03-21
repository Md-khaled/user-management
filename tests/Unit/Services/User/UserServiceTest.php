<?php

namespace Tests\Unit\Services\User;

use App\Interfaces\User\UserInterface;
use App\Models\User;
use App\Repositories\User\UserRepository;
use App\Services\User\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Request;
use PHPUnit\Framework\TestCase;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;
    protected $userService;
    protected $userRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->userRepository = $this->createMock(UserInterface::class);
        $this->userService = new UserService($this->userRepository);
    }

    public function test_it_can_create_a_user()
    {
        
    }
}
