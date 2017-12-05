<?php

namespace App\Repositories;

use App\MoreCharacteristicProduct;

class MoreCharacteristicProductRepository extends BaseRepository {

    public function __construct(MoreCharacteristicProduct $moreCharacteristicProduct) {
        $this->model = $moreCharacteristicProduct;
    }

    public function store($inputs) {
        return $this->save(new $this->model, $inputs);
    }

    public function update($id, $inputs) {
        $characteristic = $this->getById($id);
        return $this->save($characteristic, $inputs);
    }

    private function save($characteristic, $inputs) {
        $characteristic->text = $inputs['text'];
        $characteristic->save();
        return $characteristic;
    }
}