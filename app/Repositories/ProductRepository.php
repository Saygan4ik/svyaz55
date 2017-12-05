<?php

namespace App\Repositories;

use App\Product;
use Illuminate\Support\Facades\DB;

class ProductRepository extends BaseRepository {
    public function __construct(Product $product) {
        return $this->model = $product;
    }

    public function store($inputs) {
        return $this->save(new $this->model, $inputs);
    }

    public function update($slug, $inputs) {
        $product = $this->getBySlug($slug);
        return $this->save($product, $inputs);
    }

    private function save($product, $inputs) {

        $char = $inputs['characteristicProduct'];
        $syncData = [];

        foreach ($char as $key => $value) {
            if ($value) {
                $syncData[$key] = array('value' => $value);
            }
        }
        unset($value);

        $product->brand = $inputs['brand'];
        $product->name = $inputs['name'];
        $product->slug = $inputs['slug'];
        $product->price = $inputs['price'];
        $product->category = $inputs['category'];
        if(array_key_exists('visible', $inputs)) {
            $product->visible = true;
        }
        else {
            $product->visible = false;
        }
        $product->save();
        if (!array_key_exists('characteristicProduct', $inputs)) {
            $arr = array('permissions' => null);
            $inputs = array_merge($inputs, $arr);
        }
        $product->characteristics()->sync($syncData);
        if (!array_key_exists('moreCharacteristic', $inputs)) {
            $arr = array('moreCharacteristic' => null);
            $inputs = array_merge($inputs, $arr);
        }
        $product->moreCharacteristics()->sync($inputs['moreCharacteristic']);
        return $product;
    }

    public function getProductImages($id) {
        $images = DB::table('image_product')->where('product_id', $id)->get();
        return $images;
    }

    public function saveImage($inputs, $id) {
        if($inputs->hasFile('image_file')) {
            $imageData = json_decode($inputs['image_data']);
            $product = $this->getById($id);
            $image = $inputs->file('image_file');
            $extension = $image->getClientOriginalExtension();
            $path = 'image/products/'.$product->name.'-'.date('/Y/d/m/').'.'.$extension;
            $image = Image::make($image)->crop((int)$imageData->width, (int)$imageData->height, (int)$imageData->x, (int)$imageData->y)->resize(100, 100)->save($path);
            DB::insert('insert into image_product (product_id, image_name) values ($product->id, $path)');
            return true;
        }
        return false;
    }

    public function deleteImage($id) {
        if ($image = DB::table('image_product')->where('id', $id)->first()) {
            if ($image->isMain == true) {
                if ($otherImage = DB::table('image_product')->where([['product_id', $image->product_id], ['id', '<>', $image->id]])->first()) {
                    DB::table('image_product')->where('id', $otherImage->id)->update(['isMain' => true]);
                }
            }
            DB::table('image_product')->where('id', $id)->delete();
        }
        else {
            abort(404);
        }
    }

    public function setMainImage($inputs) {
        DB::table('image_product')->where('product_id', $inputs['product_id'])->update(['isMain' => false]);
        DB::table('image_product')->where('id', $inputs['image_id'])->update(['isMain' => true]);
        return $inputs['image_id'];
    }
}