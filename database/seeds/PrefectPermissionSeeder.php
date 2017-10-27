<?php

use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class PrefectPermissionSeeder extends Seeder
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
            'name' => 'View absent list',
            'description' => 'All users that has this permission can view all the absents.',
            'selectable_in_edit' => 1
        ]);

        DB::connection($connection)->table('permissions')->insert([
            'id' => Uuid::uuid1(),
            'name' => 'Excuse students',
            'description' => 'All users that has this permission can excuse students.',
            'selectable_in_edit' => 1
        ]);

    }
}
