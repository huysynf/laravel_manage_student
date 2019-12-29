<?php

namespace App\Http\Requests\Users;

use App\Rules\UpperCase;
use Illuminate\Foundation\Http\FormRequest;

class CreateRoleRequest extends FormRequest
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
            'name'=>['required','unique:roles,name'],
            'slug'=>['required','unique:roles,slug',new UpperCase()],
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'* Tên hiện thị không để trống',
            'name.unique'=>'* Tên hiện thị đã có! Chọn tên khác',
            'slug.required'=>'* Tên  không để trống',
            'slug.unique'=>'* Tên đã có! Chọn tên khác ',
        ];
    }
}
