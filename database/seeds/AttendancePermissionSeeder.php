<?php

use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class AttendancePermissionSeeder extends Seeder
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
            'name' => 'use attendance',
            'description' => 'All users that has this permission can use the attendance system, but you would need to make them a teacher.',
        ]);

    }
}
