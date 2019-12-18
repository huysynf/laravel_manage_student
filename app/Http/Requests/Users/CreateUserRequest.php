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
            'role'=>'required',
            'email'=>'required|unique:users,email',
            'image'=>'required|image|mimes:jpeg,bmp,png,jpg',
            'password'=>'required|confirmed|min:',
            'password_confirmation' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'* Tên không để trống',
            'role.required'=>'* Chọn quyền',
            'email.required'=>'* Email không được để trống',
            'email.unique'=>'* Email đã được sử dụng! Hãy sử dụng email khác.',
            'image.required'=>'* Hình ảnh không được để trống',
            'image.image'=>'* File phải là hình ành',
            'image.mimes'=>'* Ảnh có định dạng jpg,jpec,png',
            'password.required'=>'* Mật khẩu không để trống',
            'password.min'=>'* Mật khẩu lớn hơn 4 kí tự',
            'password.confirmed'=>'* Mật khẩu với nhập lại mật khẩu phải giống nhau',
            'password_confirmation.required'=>'* Nhập lại mật khẩu không để trống',
        ];
    }
}
