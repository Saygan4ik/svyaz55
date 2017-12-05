<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $slug = $this->route('product');
        return [
            'slug' => 'required|regex:#^[aA-zZ0-9\-_]+$#|string|unique:products,slug,'.$slug.',slug|max:50|min:1',
            'brand' => 'string|max:50|min:1',
            'category' => 'required',
            'price' => 'required|numeric',
            'name' => 'string|max:50|min:1'
        ];
    }
}
