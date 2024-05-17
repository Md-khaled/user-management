<?php

namespace Tests\Feature\User;

use Tests\TestCase;
use App\Models\User;
use App\Events\UserSaved;
use App\Listeners\SaveUserBackgroundInformation;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SaveUserBackgroundInformationFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function save_user_background_information_feature()
    {
        Event::fake();
        $user = User::factory()->create([
            'prefixname' => 'Mr',
            'firstname' => 'John',
            'middlename' => 'Philip',
            'lastname' => 'Doe',
        ]);

        // Act
        event(new UserSaved($user));

        // Assert
        Event::assertDispatched(UserSaved::class);
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
