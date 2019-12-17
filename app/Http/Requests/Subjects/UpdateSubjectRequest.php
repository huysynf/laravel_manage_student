<?php

namespace App\Http\Requests\Subjects;

use App\Rules\ShortStringLengt;
use App\Rules\UpperCase;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSubjectRequest extends FormRequest
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
            'name' => ['required', 'unique:subjects,name,'.$this->subject, new ShortStringLengt(), new UpperCase()],
            'description' => 'required',
            'lesson' => 'required|numeric|max:100|min:15',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '* Tên môn học không được để trống',
            'name.unique' => '* Tên môn học đã có ! Hãy thử tên khác',
            'description.required' => '* Mô tả không được để trống',
            'lesson.required' => '* Số tiết môn học không được để trống',
            'lesson.numeric' => '* Số tiết phải là số',
            'lesson.max' => '* Số tiết phải nhỏ hơn 100',
            'lesson.min' => '* Số tiết phải lớn hơn 15',

        ];
    }
}
