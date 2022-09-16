<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        // dd($this->all());
        return [
            'title' => 'required|max:255|min:10',
            'id_category' => 'required|numeric|min:1',
            'desc' => 'required',
        ];
    }

    public function messages(){

        return [
            'title.required' => 'Chưa nhập tiêu đề!',
            'title.max' => 'Tiêu đề ít hơn 255 kí tự!',
            'title.min' => 'Tiêu đề tối thiểu 10 kí tự!',
            'id_category.required' => 'Vui lòng chọn danh mục!',
            'desc.required' => 'Viết nội dung!',
        ];
    }
}
