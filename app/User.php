<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isRole() {
        return $this->belongsTo('App\Role', 'role', 'slug');
    }

    public function hasAccess(array $permissions) {
        if($this->role) {
            if ($this->isRole->hasAccess($permissions)) {
                return true;
            }
        }
        return false;
    }
}
