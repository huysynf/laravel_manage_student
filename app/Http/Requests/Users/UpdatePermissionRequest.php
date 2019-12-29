<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePermissionRequest extends FormRequest
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
            'name'=>'required|unique:permissions,name,'.$this->id,
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'* Tên hiện thị không để trống',
            'name.unique'=>'* Tên hiện thị đã có! Chọn tên khác',
        ];
    }
}
