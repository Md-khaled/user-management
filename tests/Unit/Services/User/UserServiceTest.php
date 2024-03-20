<?php

namespace Tests\Unit\Services\User;

use App\Models\User;
use App\Services\User\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;
    protected $userService;

     public function setUp(): void
    {
        parent::setUp();
        $this->userService = app(UserService::class);
    }

    public function test_it_can_create_a_user()
    {
        $userData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password',
        ];

        $user = $this->userService->create($userData);

        $this->assertInstanceOf(User::class, $user);
        $this->assertDatabaseHas('users', ['email' => 'john@example.com']);
    }
    public function test_it_can_update_a_user()
    {
        $user = User::factory()->create(['name' => 'Jane Doe']);

        $userData = [
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
        ];

        $this->userService->update($userData, $user->id);

        $this->assertDatabaseHas('users', ['email' => 'jane@example.com']);
        $this->assertDatabaseMissing('users', ['name' => 'Jane Doe']);
    }
    public function it_can_delete_a_user()
    {
        $user = User::factory()->create();

        $result = $this->userService->delete($user->id);

        $this->assertTrue($result);
        $this->assertDeleted($user);
    }
}
