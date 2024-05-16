<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use PHPUnit\Framework\TestCase;

class CreateUsersTableTest extends TestCase
{
    use RefreshDatabase;

    public function test_users_table_has_expected_columns()
    {
        $this->assertTrue(Schema::hasTable('users'), 'The users table does not exist.');

        $expectedColumns = [
            'id',
            'prefixname',
            'firstname',
            'middlename',
            'lastname',
            'suffixname',
            'username',
            'email',
            'password',
            'photo',
            'type',
            'remember_token',
            'email_verified_at',
            'created_at',
            'updated_at',
            'deleted_at',
        ];

        foreach ($expectedColumns as $column) {
            $this->assertTrue(
                Schema::hasColumn('users', $column),
                "The users table does not have the expected column: $column"
            );
        }
    }
}
