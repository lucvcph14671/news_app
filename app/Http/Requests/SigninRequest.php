<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SigninRequest extends FormRequest
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
            'name' => 'required|min:5|max:56',
            'email' => 'required|regex:/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/',
            'phone' => 'required|min:10',
            'password' => 'required|confirmed|min:6|max:32'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nhập đầy đủ họ tên!',
            'name.min' => 'Họ tên tối thiểu 5 kí tự!',
            'name.max' => 'Họ tên bạn không tồn tại!',
            'email.required' => 'Nhập email!',
            'email.regex' => 'Nhập đúng định dạng email!',
            'phone.required' => 'Nhập số điện thoại!',
            'password.required' => 'Điền mật khẩu!',
            'password.confirmed' => 'Điền mật khẩu không khớp!',
            'password.min' => 'Mật khẩu tối thiểu 6 kí tự!',
            'password.max' => 'Mật khẩu tối đa 32 kí tự!',
        ];
    }
}
