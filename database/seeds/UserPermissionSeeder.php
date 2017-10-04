<?php

use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class UserPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createDefaultPermissions(env('DB_CONNECTION', 'mysql'));
    }

    public function createDefaultPermissions($connection)
    {
        DB::connection($connection)->table('permissions')->insert([
            'id' => Uuid::uuid1(),
            'name' => 'view users',
            'description' => 'All users that has this permission can view and search the users.',
        ]);

        DB::connection($connection)->table('permissions')->insert([
            'id' => Uuid::uuid1(),
            'name' => 'create users',
            'description' => 'All users that has this permission can create a user.',
        ]);

        DB::connection($connection)->table('permissions')->insert([
            'id' => Uuid::uuid1(),
            'name' => 'edit users',
            'description' => 'All users that has this permission can edit a user.',
        ]);

        DB::connection($connection)->table('permissions')->insert([
            'id' => Uuid::uuid1(),
            'name' => 'delete users',
            'description' => 'All users that has this permission can delete a user.',
        ]);

    }
}
