<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Events\UserSaved;
use App\Listeners\SaveUserBackgroundInformation;
use App\Models\User;
use App\Services\User\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SaveUserBackgroundInformationTest extends TestCase
{
    use RefreshDatabase;

    public function test_save_user_background_information()
    {
        $userServiceMock = $this->createMock(UserService::class);
        $user = User::factory()->create([
            'prefixname' => 'Mr',
            'firstname' => 'John',
            'middlename' => 'Philip',
            'lastname' => 'Doe',
        ]);

        $userServiceMock->expects($this->once())
            ->method('saveUserBackgroundInfo')
            ->with($user);

        $listener = new SaveUserBackgroundInformation($userServiceMock);

        $listener->handle(new UserSaved($user));
        $this->assertDatabaseHas('details', [
            'user_id' => $user->id,
            'key' => 'full_name',
            'value' => 'John Philip Doe',
            'type' => 'detail',
        ]);
        $this->assertDatabaseHas('details', [
            'user_id' => $user->id,
            'key' => 'middle_initial',
            'value' => 'P.',
            'type' => 'detail',
        ]);
    }
}
