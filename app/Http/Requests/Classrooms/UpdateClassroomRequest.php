<?php

namespace App\Http\Requests\Classrooms;

use App\Rules\UpperCase;
use Illuminate\Foundation\Http\FormRequest;

class UpdateClassroomRequest extends FormRequest
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
            'name' =>['required','unique:classrooms,name,'.$this->id,new UpperCase()],
            'description' => 'required',
            'faculty_id' => 'required',
            'member' => [
                'required',
                'numeric',
                function ($attribute, $value, $fail) {
                    if (($value < 20) || ($value > 100)) {
                        return $fail('* Số lượng thành viên phải lớn hơn 20 và nhở hơn 100');
                    }
                }
            ],
            'subject_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '* Tên không được để trống',
            'name.unique' => '* Tên đã có ! Hãy thử tên khác',
            'description.required' => '* Mô tả không được để trống',
            'faculty_id.required' => '* Chọn khoa ',
            'member.required' => '* Số lượng thành viên không được để trống',
            'member.numeric' => '* Số lượng thành viên phải là số',
            'subject_id.required' => '* Chọn môn học ',

        ];
    }

}
