<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
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
    // 2023.05.12 ユーザーの新規登録画面にバリデーションを追加
    public function rules()
    {
        return [
            'over_name' => 'required|max:10',
            'under_name' => 'required|max:10',
            'over_name_kana' => 'required|max:30',
            'under_name_kana' => 'required|max:30',
            'mail_address' => 'required|max:100',
            'sex' => 'required',
            'old_year' => 'required',
            'old_month' => 'required',
            'old_day' => 'required',
            'role' => 'required',
            'password' => 'required|min:8|max:30',

        ];
    }

    public function messages(){
        return [
            'over_name.max' => '姓は10文字以内で入力してください。',
        ];
    }
}
