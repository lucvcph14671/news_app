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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|min:2|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nhập tên danh mục!',
            'name.min' => 'Tên danh mục tốt thiểu 2 kí tự!',
            'name.max' => 'Tên danh mục tối đa 255 kí tự!',
        ];
    }
}
