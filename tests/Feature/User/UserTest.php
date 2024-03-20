<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_it_can_display_a_list_of_users()
    {
        // Create 3 users
        $users = User::factory()->count(3)->create();

        // Make a GET request to the index page
        $response = $this->get(route('users.index'));

        // Assert that the response is successful (HTTP status code 200)
        $response->assertStatus(200);

        // Assert that each user's name and email are visible in the response
        foreach ($users as $user) {
            $response->assertSee($user->name);
            $response->assertSee($user->email);
        }
    }
    /** @test */
    public function test_it_can_display_the_create_user_form()
    {
        // Make a GET request to the create page
        $response = $this->get(route('users.create'));

        // Assert that the response is successful (HTTP status code 200)
        $response->assertStatus(200);

        // Assert that the "Create User" text is visible in the response
        $response->assertSee('Create User');
    }

    /** @test */
    public function test_it_can_store_a_new_user()
    {
        // Create user data
        $userData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            // Add other required fields as needed
        ];

        // Make a POST request to store the new user
        $response = $this->post(route('users.store'), $userData);

        // Assert that the user was created successfully and redirected
        $response->assertRedirect(route('users.index'));

        // Assert that the user exists in the database
        $this->assertDatabaseHas('users', $userData);
    }


    

    /** @test */
    public function test_it_can_show_a_user()
    {
        $user = User::factory()->create();

        $response = $this->get(route('users.show', $user->id));

        $response->assertStatus(200);
        $response->assertViewIs('users.show');
        $response->assertSee($user->name);
    }

    /** @test */
    public function test_it_can_edit_a_user()
    {
        $user = User::factory()->create();

        $response = $this->get(route('users.edit', $user->id));

        $response->assertStatus(200);
        $response->assertViewIs('users.edit');
        $response->assertSee($user->name);
    }

    /** @test */
    public function test_it_can_update_a_user()
    {
        $user = User::factory()->create();
        $newName = 'Updated Name';

        $response = $this->put(route('users.update', $user->id), [
            'name' => $newName,
            // Add other fields as needed
        ]);

        $response->assertRedirect(route('users.show', $user->id));
        $this->assertEquals($newName, $user->fresh()->name);
    }

    /** @test */
    public function test_it_can_delete_a_user()
    {
        $user = User::factory()->create();

        $response = $this->delete(route('users.destroy', $user->id));

        $response->assertRedirect(route('users.index'));
        $this->assertNull(User::find($user->id));
    }
}
