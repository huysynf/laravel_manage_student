<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class SetPasswordRequest extends FormRequest
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
        return [
            'password' => 'required|min:6|confirmed'
        ];
    }
    public function messages()
    {
        return [
            'password.required' => 'Mật  khẩu không để trống',
            'password.min' => 'Mật khẩu lớn hơn 6 kí tụ',
            'password.confirmed' => 'Nhập lại mật khẩu phải giống mật khẩu',
        ];
    }
}
