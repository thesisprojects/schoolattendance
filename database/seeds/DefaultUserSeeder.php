<?php

use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\App;
use App\User;
use App\Permission;
use App\Role;
use App\Company;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createSuperUserWithPermissions([
            'id' => Uuid::uuid1(),
            'first_name' => 'Developer',
            'last_name' => 'Doe',
            'username' => 'd.doe',
            'email' => 'd.doe@gmail.com',
            'password' => bcrypt('secret'),
        ], env('DB_CONNECTION', 'mysql'));
    }

    public function createSuperUserWithPermissions($data, $connection)
    {
        $user_id = Uuid::uuid1();

        $user = new User;
        $user->newConnection($connection);
        $user->id = $user_id;
        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->password = bcrypt('secret');
        $user->save();

        $adminRole = new Role;
        $adminRole->newConnection($connection);
        $adminRole->id = Uuid::uuid1();
        $adminRole->name = 'Developer';
        $adminRole->description = 'Super User';
        $adminRole->save();

        DB::connection($connection)->table('user_roles')->insert([
            'id' => Uuid::uuid1(),
            'user_id' => $user_id,
            'role_id' => $adminRole->id,
        ]);

        $viewRolesPermission = Permission::on($connection)->where('name', '=', 'view roles')->first();
        $editRolesPermission = Permission::on($connection)->where('name', '=', 'edit roles')->first();
        $addRolesPermission = Permission::on($connection)->where('name', '=', 'create roles')->first();
        $deleteRolesPermission = Permission::on($connection)->where('name', '=', 'delete roles')->first();
        $viewDashboardPermission = Permission::on($connection)->where('name', '=', 'view dashboard')->first();

        DB::connection($connection)->table('role_permissions')->insert([
            'id' => Uuid::uuid1(),
            'role_id' => $adminRole->id,
            'permission_id' => $viewRolesPermission->id,
        ]);

        DB::connection($connection)->table('role_permissions')->insert([
            'id' => Uuid::uuid1(),
            'role_id' => $adminRole->id,
            'permission_id' => $editRolesPermission->id,
        ]);

        DB::connection($connection)->table('role_permissions')->insert([
            'id' => Uuid::uuid1(),
            'role_id' => $adminRole->id,
            'permission_id' => $addRolesPermission->id,
        ]);

        DB::connection($connection)->table('role_permissions')->insert([
            'id' => Uuid::uuid1(),
            'role_id' => $adminRole->id,
            'permission_id' => $deleteRolesPermission->id,
        ]);

        DB::connection($connection)->table('role_permissions')->insert([
            'id' => Uuid::uuid1(),
            'role_id' => $adminRole->id,
            'permission_id' => $viewDashboardPermission->id,
        ]);
    }
}
