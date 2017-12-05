<?php

namespace App\Repositories;

use App\Category;

class CategoryRepository extends BaseRepository {
    public function __construct(Category $category) {
        return $this->model = $category;
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
        if(array_key_exists('isVisible', $inputs)) {
            $role->visible = true;
        }
        else {
            $role->visible = false;
        }
        $role->save();
    }
}