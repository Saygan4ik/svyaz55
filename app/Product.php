<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category() {
        return $this->belongsTo('products', 'category', 'slug');
    }

    public function characteristics() {
        return $this->belongsToMany('App\CharacteristicProduct', 'characteristicProduct_product', 'product_id', 'characteristic_id')->withPivot('value');
    }

    public function moreCharacteristics() {
        return $this->belongsToMany('App\MoreCharacteristicProduct', 'moreCharacteristicProduct_product', 'product_id', 'moreCharacteristic_id');
    }
}
