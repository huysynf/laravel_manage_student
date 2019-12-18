<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name'=>'required',
            'role'=>'required',
            'email'=>'required|unique:users,email,'.$this->user,
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'* Tên không để trống',
            'role.required'=>'* Chọn quyền',
            'email.required'=>'* Email không được để trống',
            'email.unique'=>'* Email đã được sử dụng! Hãy sử dụng email khác.',
        ];
    }
}
