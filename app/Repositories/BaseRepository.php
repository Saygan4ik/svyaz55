<?php

namespace App\Repositories;

abstract class BaseRepository {

    protected $model;

    public function all($columns = array('*')) {
        return $this->model->get($columns);
    }

    public function paginate($perPage = 10, $columns = array('*')) {
        return $this->model->paginate($perPage, $columns);
    }

    public function getById($id, $columns = array('*')) {
        $item = $this->model->where('id', $id)->first($columns);
        if($item) {
            return $item;
        }
        return abort(404);
    }

    public function getBySlug($slug, $columns = array('*')) {
        $item = $this->model->where('slug', $slug)->first($columns);
        if($item) {
            return $item;
        }
        return abort(404);
    }

    public function delete($id) {
        $this->model->destroy($id);
    }
}