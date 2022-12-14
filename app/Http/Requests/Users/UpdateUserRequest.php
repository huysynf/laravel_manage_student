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
            'role_id'=>'required',
            'phone'=>'required|regex:/\d{3}-\d{4}-\d{3}/',
            'email'=>'required|email|unique:users,email,'.$this->id,
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'* Tên không để trống',
            'role_id.required'=>'* Chọn quyền',
            'email.required'=>'* Email không được để trống',
            'email.unique'=>'* Email đã được sử dụng! Hãy sử dụng email khác.',
            'email.email'=>'* Email không đúng định dạng.',
            'phone.required'=>'* Số điện thoại không để trống',
            'phone.regex'=>'* Số điện thoại có dạng XXX-XXXX-XXX',
        ];
    }
}
