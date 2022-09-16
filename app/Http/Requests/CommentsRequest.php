<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentsRequest extends FormRequest
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
            'comment' => 'required|min:2|max:255',
        ];
    }

    public function messages()
    {
        return [
            'comment.required' => 'Nhập comment!',
            'comment.min' => 'Tên comment tốt thiểu 2 kí tự!',
            'comment.max' => 'Tên comment tối đa 255 kí tự!',
        ];
    }
}
