<?php

use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class StudentPermissionsSeeder extends Seeder
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
            'name' => 'view students',
            'description' => 'All users that has this permission can view and search the students.',
        ]);

        DB::connection($connection)->table('permissions')->insert([
            'id' => Uuid::uuid1(),
            'name' => 'create students',
            'description' => 'All users that has this permission can create a student.',
        ]);

        DB::connection($connection)->table('permissions')->insert([
            'id' => Uuid::uuid1(),
            'name' => 'edit students',
            'description' => 'All users that has this permission can edit a student.',
        ]);

        DB::connection($connection)->table('permissions')->insert([
            'id' => Uuid::uuid1(),
            'name' => 'delete students',
            'description' => 'All users that has this permission can delete a student.',
        ]);
    }
}
