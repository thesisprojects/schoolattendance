<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $connection = 'mysql';

    public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'first_name', 'last_name', 'email', 'password', 'isTeacher'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function newConnection($connection)
    {
        $this->connection = $connection;
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role', 'user_roles', 'user_id', 'role_id');
    }

    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }

    public function hasRole($role)
    {
        return $this->roles()->where('name', $role)->first() ? true : false;
    }

    public function hasAnyPermission($required_permissions)
    {
        if (is_array($required_permissions)) {
            foreach ($required_permissions as $required_permission) {
                if ($this->hasPermission($required_permission)) {
                    return true;
                }
            }
        } else {
            if ($this->hasPermission($required_permissions)) {
                return true;
            }
        }
        return false;
    }

    public function hasPermission($required_permission)
    {
        $roles = $this->roles;
        foreach ($roles as $role) {
            foreach ($role->permissions as $permission) {
                if ($permission->name == $required_permission) {
                    return true;
                }
            }
        }

        return false;
    }

}
