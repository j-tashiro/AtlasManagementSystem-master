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
            'over_name' => 'required|max:10|string',
            'under_name' => 'required|max:10|string',
            // 2023.05.13 カタカナのバリデーション regex:/\A[ァ-ヶー]+\z/u
            'over_name_kana' => 'required|max:30|string|regex:/\A[ァ-ヶー]+\z/u',
            'under_name_kana' => 'required|max:30|string|regex:/\A[ァ-ヶー]+\z/u',
            'mail_address' => 'required|max:100|email|unique:users,mail_address',
            'sex' => 'required|in:1,2,3,',
            'old_year' => 'required|integer',
            'old_month' => 'required',
            'old_day' => 'required',
            'role' => 'required|in:1,2,3,4,',
            'password' => 'required|min:8|max:30|confirmed',

            'concatenated' => 'required|before_or_equal:today',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'concatenated' => $this->input('old_year') . '_' . $this->input('old_month') . '_' . $this->input('old_day')
        ]);
    }

    public function messages(){
        return [
            'over_name.max' => '姓は10文字以内で入力してください。',
        ];
    }
}
