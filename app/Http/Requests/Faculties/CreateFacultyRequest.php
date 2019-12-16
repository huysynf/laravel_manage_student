<?php

namespace App\Http\Requests\Faculties;

use App\Rules\ShortStringLengt;
use App\Rules\UpperCase;
use Illuminate\Foundation\Http\FormRequest;

class CreateFacultyRequest extends FormRequest
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
            'name' => ['required', 'unique:faculties,name', new ShortStringLengt(), new UpperCase()],
            'description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '* Tên khoa không được để trống',
            'name.unique' => '* Tên khoa đã có ! Hãy thử tên khác',
            'description.required' => '* Mô tả không được để trống',
        ];
    }
}
