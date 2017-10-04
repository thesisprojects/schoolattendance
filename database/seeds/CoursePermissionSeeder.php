<?php

use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class CoursePermissionSeeder extends Seeder
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
            'name' => 'view courses',
            'description' => 'All users that has this permission can view and search the courses.',
        ]);

        DB::connection($connection)->table('permissions')->insert([
            'id' => Uuid::uuid1(),
            'name' => 'create courses',
            'description' => 'All users that has this permission can create a course.',
        ]);

        DB::connection($connection)->table('permissions')->insert([
            'id' => Uuid::uuid1(),
            'name' => 'edit courses',
            'description' => 'All users that has this permission can edit a course.',
        ]);

        DB::connection($connection)->table('permissions')->insert([
            'id' => Uuid::uuid1(),
            'name' => 'delete courses',
            'description' => 'All users that has this permission can delete a course.',
        ]);

        DB::connection($connection)->table('permissions')->insert([
            'id' => Uuid::uuid1(),
            'name' => 'assign courses',
            'description' => 'All users that has this permission can assign a course to a user.',
        ]);

    }
}
