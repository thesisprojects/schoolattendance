<?php

namespace App\Http\Controllers;

use App\Company;
use App\Permission;
use Illuminate\Http\Request;
use App\Role;
use Auth;
use League\Flysystem\Exception;
use App\CCPortal\Classes\Helpers\ArrayHelpers;
use App\CCPortal\Classes\Repositories\Repository;
use App\CCPortal\Classes\Repositories\RoleRepository;
use Ramsey\Uuid\Uuid;

class RoleController extends Controller
{
    private $repository;

    public function __construct()
    {
        $this->repository = new Repository(new RoleRepository);
    }

    public function index()
    {
        try {
            $roles = Role::with('permissions')->get();

            $permissions = Permission::where('selectable_in_add', 1)->get();

            return view('pages.roles.index')->with([
                'roles' => $roles,
                'permissions' => $permissions
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Something fatal went up',
                'error' => $exception->getMessage()
            ], 500);
        }

    }

    public function postCreate(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required|min:2|max:8',
                'description' => 'required|min:4|max:16',
            ]);
            $data = $request->all();
            $selectedPermissions = ArrayHelpers::getValuesContainsKey($data, 'role_data');
            $data['permissions'] = $selectedPermissions;
            $this->repository->create($data);
            return back()->with('status', 'Role created.');
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Something fatal went up',
                'error' => $exception->getMessage()
            ], 500);
        }
    }

    public function edit($roleID)
    {
        try {
            $role = Role::find($roleID);
            $permissions = Permission::where('selectable_in_edit', 1)->get();
            return view('pages.roles.edit')->with(['role' => $role, 'permissions' => $permissions]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Something fatal went up',
                'error' => $exception->getMessage()
            ], 500);
        }
    }

    public function postTogglePermissions(Request $request)
    {
        try {
            $data = $request->all();
            $role = Role::with('permissions')->find($data['role']);
            if ($role->permissions->contains('id', $data['permission'])) {
                $role->permissions()->detach($data['permission']);
                return response()->json([
                    'status' => 200,
                    'message' => 'Permission removed.'
                ], 200);
            }
            $role->permissions()->attach($data['permission'], ['id' => Uuid::uuid1()]);
            return response()->json([
                'status' => 500,
                'message' => 'Permission added.'
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Something fatal went up',
                'error' => $exception->getMessage()
            ], 500);
        }

    }

    public function getRoles()
    {
        try {
            $company = Auth::user()->company()->with([
                'roles' => function ($query) {
                    $query->addSelect(['id', 'name', 'company_id']);
                }
            ])->first();

            return $company->roles;
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Something fatal went up',
                'error' => $exception->getMessage()
            ], 500);
        }
    }
}
