<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    public function permissions() {
        return $this->belongsToMany('App\Permission', 'permission_role', 'role_id', 'permission_id');
    }

    public function users() {
        return $this->hasMany('App\User', 'role', 'slug');
    }

    public function hasAccess(array $permissions) {
        $count = 0;
        foreach ($permissions as $permission) {
            if ($this->hasPermission($permission)) {
                $count++;
            }
        }
        if ($count == count($permissions)) {
            return true;
        }
        return false;
    }

    public function hasPermission($permission) {
        foreach ($this->permissions as $permissionThisRole) {
            if ($permissionThisRole->slug === $permission) {
                return true;
            }
        }
        return false;
    }
}
