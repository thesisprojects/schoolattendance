<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class UserController extends Controller
{
    public function getUsers()
    {
        $users = User::with('roles')->paginate(10);
        $roles = Role::all();
        return view("pages.users.view")->with([
            'users' => $users,
            'roles' => $roles
        ]);
    }

    public function getEdit($id)
    {
        $user = User::find($id)->with('roles')->first();
        if ($user->roles->count()) {
            $roles = Role::where('id', '!=', $user->roles->first()->id)->get();
        } else {
            $roles = Role::all();
        }
        return view("pages.users.edit")->with([
            'user' => $user,
            'roles' => $roles
        ]);
    }

    public function postUpdate(Request $request)
    {
        try {
            $this->validate($request, [
                'first_name' => 'required|min:2|max:40',
                'last_name' => 'required|min:2|max:40',
                'username' => 'required|min:2|max:10',
                'email' => 'required|min:2|max:40',
                'role' => 'required',
            ]);
            $data = $request->all();
            $user = User::find($data['id'])->with('roles')->first();
            $oldRole = $user->roles->count() ? $user->roles->first()->id : null;
            $user->first_name = $data['first_name'];
            $user->last_name = $data['last_name'];
            $user->username = $data['username'];
            $user->email = $data['email'];
            if (!is_null($data['password'])) {
                $user->password = Hash::make($data['password']);
            }
            $user->save();
            if ($data['role'] != $oldRole) {
                $user->roles()->detach($oldRole);
                $user->roles()->attach($data['role'], ['id' => Uuid::uuid1()]);
            }
            return back()->with('status', 'User updated.');
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
                'first_name' => 'required|min:2|max:40',
                'last_name' => 'required|min:2|max:40',
                'username' => 'required|min:2|max:10',
                'email' => 'required|min:2|max:40',
                'password' => 'required',
                'role' => 'required',
            ]);
            $data = $request->all();
            $data['password'] = Hash::make($data['password']);
            $user = new User($data);
            $user->id = Uuid::uuid1();
            $user->save();
            $user->roles()->attach($data['role'], ["id" => Uuid::uuid1()]);
            return back()->with('status', 'User created.');
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Something fatal went up',
                'error' => $exception->getMessage()
            ], 500);
        }
    }
}
