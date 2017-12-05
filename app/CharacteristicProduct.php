<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CharacteristicProduct extends Model
{
    protected $table = 'characteristicsProduct';

    public function products() {
        return $this->belongsToMany('App\Product', 'characteristicProduct_product', 'characteristic_id', 'product_id')->withPivot('value');
    }
}
