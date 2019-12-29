<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'email'=>'required|unique:users,email','email',
            'phone'=>'required|regex:/\d{3}-\d{4}-\d{3}/',
            'image'=>'required|image|mimes:jpeg,bmp,png,jpg',
            'password'=>'required|confirmed|min:',
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
            'image.required'=>'* Hình ảnh không được để trống',
            'image.image'=>'* File phải là hình ành',
            'image.mimes'=>'* Ảnh có định dạng jpg,jpec,png',
            'password.required'=>'* Mật khẩu không để trống',
            'password.min'=>'* Mật khẩu lớn hơn 4 kí tự',
            'password.confirmed'=>'* Mật khẩu với nhập lại mật khẩu phải giống nhau',
        ];
    }
}
