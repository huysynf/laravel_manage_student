<?php

namespace App\Http\Requests\Students;

use App\Rules\UpperCase;
use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
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
            'name'=>['required','unique:students,name,'.$this->student,new UpperCase()],
            'birthday'=>'required',
            'phone'=>'required|regex:/\d{3}-\d{4}-\d{3}/',
            'gender'=>'required',
            'address'=>'required',
            'classrooms'=>'required|array|min:1',

        ];
    }
    public  function  messages()
    {
        return [
            'name.required'=>'* Tên không được để trống',
            'name.unique'=>'* Tên đã tồn tại! Hãy thử lại với tên khác',
            'phone.required'=>'* Số điện thoại không để trống',
            'phone.regex'=>'* Số điện thoại có dạng XXX-XXXX-XXX',
            'gender.required'=>'* Chọn giới tính',
            'address.required'=>'Địa chỉ không để trống',
            'birthday.required'=>'Ngày sinh nhật không để trống',
            'classrooms.required'=>'* Chọn lớp ',
        ];
    }
}
