<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        $slug = $this->route('category');
        return [
            'name' => 'required|string|unique:categories,name,'.$slug.',slug|max:50|min:1',
            'slug' => 'required|regex:#^[aA-zZ0-9\-_]+$#|string|unique:categories,slug,'.$slug.',slug|max:50|min:1'
        ];
    }
}
