<?php

namespace App\Http\Requests\BulletinBoard;

use Illuminate\Foundation\Http\FormRequest;

class PostFormRequest extends FormRequest
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
            // 2023.05.23 viewファイルに記述してあるname属性とリンクしてる
            'post_title' => 'required|max:100',
            'post_body' => 'required|max:5000',
        ];
    }

    public function messages(){
        return [
            'post_title.max' => 'タイトルは50文字以内で入力してください。',
            'post_title.required' => '必須だぜ？',
            'post_body.max' => '最大文字数は500文字です。',
            'post_body.required' => '必須だぜ？',
        ];
    }

}