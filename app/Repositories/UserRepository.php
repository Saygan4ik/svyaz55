<?php

namespace App\Repositories;

use App\Role;
use App\User;
use App\Repositories\RoleRepository;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class UserRepository extends BaseRepository {

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function save($user, $inputs) {
        $user->name = $inputs['name'];

        if($user->save()) {
            if($inputs->hasFile('avatar')) {
                $image = $inputs->file('avatar');
                $extension = $image->getClientOriginalExtension();
                $path = 'image/avatar/'.$user->id.'.'.$extension;
                $image = Image::make($image)->resize(50, 50)->save($path);
                $user->avatar = $path;
                $user->save();
            }
        }
    }

    public function update($id, $inputs) {
        $user = $this->getById($id);
        return $this->save($user, $inputs);
    }
}