<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Date;

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
    // 2023.05.15 ユーザーの新規登録画面にバリデーションを追加
    public function rules()
    {
        return [
            'over_name' => 'required|max:10|string',
            'under_name' => 'required|max:10|string',
            // 2023.05.13 カタカナのバリデーション regex:/\A[ァ-ヶー]+\z/u 苦労した所
            'over_name_kana' => 'required|max:30|string|regex:/\A[ァ-ヶー]+\z/u',
            'under_name_kana' => 'required|max:30|string|regex:/\A[ァ-ヶー]+\z/u',
            'mail_address' => 'required|max:100|email|unique:users,mail_address',
            // 2023.05.15 ユーザーの新規登録画面にバリデーションを追加 苦労した所
            'sex' => 'required|in:1,2,3,',
            'old_year' => 'required|integer',
            'old_month' => 'required',
            'old_day' => 'required',
            'role' => 'required|in:1,2,3,4,',
            'password' => 'required|min:8|max:30|confirmed',
            // 2023.05.15 ユーザーの新規登録画面にバリデーションを追加 苦労した所
            'birthDate' => 'required|after_or_equal:2000/1/1|date|date_format:Y-m-d',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            // 2023.05.15 ユーザーの新規登録画面にバリデーションを追加 苦労した所
            'birthDate' => $this->input('old_year') . '-' . $this->input('old_month') . '-' . $this->input('old_day')
        ]);
    }

    public function messages(){
        return [
            'over_name.required' => '姓は必ず入力してください。',
            'over_name.max' => '姓は10文字以内で入力してください。',
            'under_name.required' => '名前は必ず入力してください。',
            'under_name.max' => '名前は10文字以内で入力してください。',
            'over_name_kana.required' => 'セイは必ず入力してください。',
            'over_name_kana.max' => 'セイは30文字以内で入力してください。',
            'under_name_kana.required' => 'ナマエは必ず入力してください。',
            'under_name_kana.max' => 'ナマエは30文字以内で入力してください。',
            'mail_address.required' => '必須項目です。',
            'mail_address.max' => '100文字以内で入力してください。',
            'mail_address.unique' => 'すでに使用されているメールアドレスです。',
        ];
    }
}
