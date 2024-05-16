<?php

namespace Tests\Feature\User;

use App\Traits\CreateDummyUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase, CreateDummyUser;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = $this->createUser();
        $this->actingAs($this->user);
    }

    public function test_it_displays_users_list()
    {
        $this->createUser(5);

        $response = $this->get(route('users.index'));

        $response->assertStatus(200);
        $response->assertViewIs('users.index');
        $response->assertViewHas('users');
    }

    public function test_it_displays_create_user_form()
    {
        $response = $this->get(route('users.create'));

        $response->assertStatus(200);
        $response->assertViewIs('users.create');
    }

    public function test_it_stores_new_user()
    {
        $userData = $this->user->toArray();
        $userData['password'] = 'password';
        $response = $this->from(route('users.create'))->post(route('users.store'), $userData);

        $response->assertStatus(302);
        $response->assertRedirect(route('users.create'));
        $this->assertDatabaseHas('users', ['email' => $userData['email']]);
    }

    public function test_it_displays_user_details()
    {
        $user = $this->createUser();

        $response = $this->get(route('users.show', $user->id));

        $response->assertStatus(200);
        $response->assertViewIs('users.show');
        $response->assertViewHas('user', $user);
    }

    public function test_it_displays_edit_user_form()
    {
        $user = $this->user;

        $response = $this->get(route('users.edit', $user->id));

        $response->assertStatus(200);
        $response->assertViewIs('users.edit');
        $response->assertViewHas('user', $user);
    }

    public function test_it_updates_user()
    {
        $user = $this->user;
        $updateData = [
            'firstname' => 'UpdatedName',
            'prefixname' => $user->prefixname,
            'middlename' => $user->middlename,
            'lastname' => $user->lastname,
            'suffixname' => $user->suffixname,
            'username' => $user->username,
            'email' => $user->email,
            'type' => $user->type,
        ];
        $url = route('users.update', $user->id);

        $response = $this->from($url)->put($url, $updateData);

        $response->assertStatus(302);
        $response->assertRedirect($url);
        $this->assertDatabaseHas('users', ['id' => $user->id, 'firstname' => 'UpdatedName']);
    }

    public function test_it_updates_user_validation_errors_redirect_back_to_form()
    {
        $user = $this->user;
        $updateData = [
            'firstname' => '',
            'lastname' => '',
        ];
        $url = route('users.update', $user->id);

        $response = $this->from($url)->put($url, $updateData);

        $response->assertStatus(302);
        $response->assertInvalid(['firstname', 'lastname']);
    }

    public function test_it_deletes_user()
    {
        $user = $this->user;

        $response = $this->delete(route('users.destroy', $user->id));

        $response->assertStatus(302);
        $response->assertRedirect(route('users.index'));
        $this->assertSoftDeleted('users', ['id' => $user->id]);
    }

    public function test_it_displays_trashed_users()
    {
        $user = $this->createSoftDeleteUser(10);

        $response = $this->get(route('users.trashed'));

        $response->assertStatus(200);
        $response->assertViewIs('users.deleted-list');
        $response->assertViewHas('deletedUsers');
    }

    public function test_it_restores_soft_deleted_user()
    {
        $user = $this->createSoftDeleteUser();
        $url = route('users.restore', $user->id);

        $response = $this->from($url)->patch($url);

        $response->assertStatus(302);
        $response->assertRedirect($url);
        $this->assertDatabaseHas('users', ['id' => $user->id, 'deleted_at' => null]);
    }

    public function test_it_permanently_deletes_user()
    {
        $user = $this->createSoftDeleteUser();
        $url = route('users.delete', $user->id);

        $response = $this->from($url)->delete($url);

        $response->assertStatus(302);
        $response->assertRedirect($url);
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}
