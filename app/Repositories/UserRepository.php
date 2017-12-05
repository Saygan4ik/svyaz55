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
        $user->save();
    }

    public function update($id, $inputs) {
        $user = $this->getById($id);
        return $this->save($user, $inputs);
    }

    public function saveAvatar($inputs, $id) {
        if($inputs->hasFile('image_file')) {
            $avatarData = json_decode($inputs['image_data']);
            $user = $this->getById($id);
            $image = $inputs->file('image_file');
            $extension = $image->getClientOriginalExtension();
            $path = 'image/avatar/'.$id.'.'.$extension;
            $image = Image::make($image)->crop((int)$avatarData->width, (int)$avatarData->height, (int)$avatarData->x, (int)$avatarData->y)->resize(100, 100)->save($path);
            $user->avatar = $path;
            $user->save();
            return true;
        }
        return false;
    }

    public function deleteAvatar($id) {
        $user = $this->getById($id);
        $user->avatar = 'image/avatar/default.png';
        $user->save();
    }
}