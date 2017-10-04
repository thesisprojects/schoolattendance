<?php

use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class RolePermissionSeeder extends Seeder
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
            'name' => 'create roles',
            'description' => 'All users that has this permission can view the dashboard.',
            'selectable_in_edit' => 0
        ]);

        DB::connection($connection)->table('permissions')->insert([
            'id' => Uuid::uuid1(),
            'name' => 'view roles',
            'description' => 'All users that has this permission can view the roles.',
            'selectable_in_edit' => 0
        ]);

        DB::connection($connection)->table('permissions')->insert([
            'id' => Uuid::uuid1(),
            'name' => 'edit roles',
            'description' => 'All users that has this permission can edit a role.',
            'selectable_in_edit' => 0
        ]);

        DB::connection($connection)->table('permissions')->insert([
            'id' => Uuid::uuid1(),
            'name' => 'delete roles',
            'description' => 'All users that has this permission can delete a role.',
            'selectable_in_edit' => 0
        ]);

    }
}
