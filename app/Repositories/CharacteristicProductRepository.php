<?php

namespace App\Repositories;

use App\CharacteristicProduct;

class CharacteristicProductRepository extends BaseRepository {

    public function __construct(CharacteristicProduct $characteristicProduct) {
        $this->model = $characteristicProduct;
    }

    public function store($inputs) {
        return $this->save(new $this->model, $inputs);
    }

    public function update($slug, $inputs) {
        $characteristic = $this->getBySlug($slug);
        return $this->save($characteristic, $inputs);
    }

    private function save($characteristic, $inputs) {
        $characteristic->slug = $inputs['slug'];
        $characteristic->name = $inputs['name'];
        $characteristic->unit = $inputs['unit'];
        $characteristic->save();
        return $characteristic;
    }
}