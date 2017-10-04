<?php

use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class SubjectPermissionsSeeder extends Seeder
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
            'name' => 'view subjects',
            'description' => 'All users that has this permission can view and search the subjects.',
        ]);

        DB::connection($connection)->table('permissions')->insert([
            'id' => Uuid::uuid1(),
            'name' => 'create subjects',
            'description' => 'All users that has this permission can create a subject.',
        ]);

        DB::connection($connection)->table('permissions')->insert([
            'id' => Uuid::uuid1(),
            'name' => 'edit subjects',
            'description' => 'All users that has this permission can edit a subject.',
        ]);

        DB::connection($connection)->table('permissions')->insert([
            'id' => Uuid::uuid1(),
            'name' => 'delete subjects',
            'description' => 'All users that has this permission can delete a subject.',
        ]);

        DB::connection($connection)->table('permissions')->insert([
            'id' => Uuid::uuid1(),
            'name' => 'assign subjects',
            'description' => 'All users that has this permission can assign a subject to a student.',
        ]);
    }
}
