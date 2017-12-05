<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MoreCharacteristicProduct extends Model
{
    protected $table = 'moreCharacteristicsProduct';

    public function products() {
        return $this->belongsToMany('App\Product', 'moreCharacteristicProduct_product', 'moreCharacteristic_id', 'product_id');
    }
}
