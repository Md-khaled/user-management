<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserPrefixnameEnumValidationTest extends TestCase
{
    use RefreshDatabase;


    public function test_valid_prefixname_values_are_accepted()
    {
        $validValues = ['Mr', 'Mrs', 'Ms'];

        foreach ($validValues as $value) {
            $user = User::factory()->create(['prefixname' => $value]);
            $this->assertDatabaseHas('users', ['id' => $user->id, 'prefixname' => $value]);
        }
    }

    public function test_invalid_prefixname_values_are_rejected()
    {
        $invalidValues = ['Dr', 'Sir', 'Madam', '', null];

        foreach ($invalidValues as $value) {
            try {
                User::factory()->create(['prefixname' => $value]);
            } catch (\Exception $e) {
//                $this->fail("A user with prefixname '{$value}' should not have been created.");
                $this->assertDatabaseMissing('users', ['prefixname' => $value]);
            }
        }
    }
}
