<?php

namespace App\Http\Requests\Students;

use App\Rules\UpperCase;
use Illuminate\Foundation\Http\FormRequest;

class CreateStudentRequest extends FormRequest
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
            'name'=>['required','unique:students,name',new UpperCase()],
            'birthday'=>'required',
            'image'=>'required|image|mimes:jpeg,bmp,png',
            'phone'=>'required|regex:/\d{3}-\d{4}-\d{3}/',
            'gender'=>'required',
            'address'=>'required',
            'classrooms'=>'required|array|min:1',

        ];
    }
    public  function  messages()
    {
        return [
            'name.required'=>'* Tên sinh viên không được để trống',
            'name.unique'=>'* Tên sinh viên đã tồn tại! Hãy thử lại với tên khác',
            'image.required'=>'* Ảnh đại diện là bắt buộc',
            'image.image'=>'* Ảnh đại diện phải là hình ảnh',
            'image.mines'=>'* Ảnh đại diện phỉa là 1 trong các định dạng JPG,PNG,BMP',
            'phone.required'=>'* Số điện thoại không để trống',
            'phone.regex'=>'* Số điện thoại có dạng XXX-XXXX-XXX',
            'gender.required'=>'* Chọn giới tính',
            'address.required'=>'Địa chỉ không để trống',
            'birthday.required'=>'Ngày sinh nhật không để trống',
            'classrooms.required'=>'* Chọn lớp ',
        ];
    }
}
