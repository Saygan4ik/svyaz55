<?php

namespace App\Repositories;

use App\Role;

class RoleRepository extends BaseRepository {

    public function __construct(Role $role) {
        return $this->model = $role;
    }

    public function store($inputs) {
        return $this->save(new $this->model, $inputs);
    }

    public function update($slug, $inputs) {
        $role = $this->getBySlug($slug);
        return $this->save($role, $inputs);
    }

    private function save($role, $inputs) {
        $role->name = $inputs['name'];
        $role->slug = $inputs['slug'];
        $role->save();
        if (!array_key_exists('permissions', $inputs)) {
            $arr = array('permissions' => null);
            $inputs = array_merge($inputs, $arr);
        }
        $role->permissions()->sync($inputs['permissions']);
        return $role;
    }
}