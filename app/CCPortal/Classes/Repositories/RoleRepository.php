<?php
namespace App\CCPortal\Classes\Repositories;
use App\CCPortal\Interfaces\Repository\IRoleRepository;
use App\Role;
use Ramsey\Uuid\Uuid;
use Auth;

class RoleRepository implements IRoleRepository
{


    public function create(array $data)
    {
        $role = new Role;
        $role->id = Uuid::uuid1();
        $role->name = $data['name'];
        $role->description = $data['description'];
        $role->save();
        foreach ($data['permissions'] as $permission) {
            $role->permissions()->attach($permission, ["id" => Uuid::uuid1()]);
        }
    }

    public function getAll()
    {
        return Role::paginate(9);
    }

    public function getOne($id)
    {
        return Role::find($id);
    }

    public function update($id, array $data)
    {
        $role = Role::find($id);
        $role->name = $data['name'];
        $role->description = $data['description'];
        $role->save();
    }

    public function updatePermissions($data)
    {
        $role = Role::find($data['roleId']);
        $roleHasPermission = count($role->permissions()->where('permission_id', $data['permissionId'])->get()) > 0 ? true : false;
        if ($roleHasPermission) {
            $role->permissions()->detach($data['permissionId']);
        } else {
            $role->permissions()->attach($data['permissionId'], ['id' => Uuid::generate()]);
        }
    }

    public function delete($id)
    {
        $role = Role::find($id);
        $role->permissions()->detach();
        $role->delete();
    }
}
