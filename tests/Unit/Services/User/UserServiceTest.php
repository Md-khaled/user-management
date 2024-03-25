<?php

namespace Tests\Unit\Services\User;

use App\Interfaces\User\UserInterface;
use App\Models\User;
use App\Repositories\User\UserRepository;
use App\Services\User\UserService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Request;
//use PHPUnit\Framework\TestCase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
class UserServiceTest extends TestCase
{
    use
        RefreshDatabase,
//        DatabaseTransactions,
        WithoutMiddleware;
    protected $userService;
    protected $userRepository;

    public function setUp(): void
    {
        parent::setUp();
//        $this->userRepository = $this->createMock(UserInterface::class);
//        $this->userService = new UserService($this->userRepository);
//        $this->disableTransactions();
    }

//    public function test_it_can_create_a_user()
//    {
//
//    }

    public function test_get_user_list(): void
    {
        $user = User::factory(20)->create();
        $response = $this->withHeaders(['Accept' => 'application/json'])
                 ->actingAs($user)
                 ->get('/users');
        $response->dd();
        $response->assertStatus(302);

    }
    public function test_user_create_successfully(): void
    {
        Artisan::call('config:clear');
        Storage::fake('avatars');
        $file = UploadedFile::fake()->image('avatar.jpg');
        $user = User::factory()->create();
        $payload = [
            'name' => 'Sally',
            'email' => 'sally@gmail.com',
            'phone' => '01671223344',
            'password' => 'password',
            'password_confirmation' => 'password',
            'file' => $file
        ];

        $response = $this->withHeaders(['Accept' => 'application/json'])
            ->actingAs($user)
            ->post('/users', $payload);

        $this->assertDatabaseHas('users', [
            'name' => 'Sally',
            'email' => 'sally@gmail.com',
            'phone' => '01671223344']);
        $response->assertStatus(302);
    }
}
