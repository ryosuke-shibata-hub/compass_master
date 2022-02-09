<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'username' => ['required','string','max:30'],
            'email' => ['required','email','unique:users','max:100'],
            'password' => ['required','string','max:30','min:8','same:password_confirmed'],
            'password_confirmed' => ['same:password'],
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'ユーザー名入れろや！',
            'username.string'=> '文字列でいれて',
            'username.max' => '最大30文字！',
            'email.required' => 'メアド入れて！',
            'email.email' => 'メールアドレス入れて！',
            'email.unique' => 'そのメアドは登録済みだよ！',
            'email.max' => '最大30文字だよ！',
            'password.required' => 'パスワードpいれて！',
            'password.min' => '最低8文字入れて！',
            'password.max' => '最大30文字にして！',
            // 'password.confirmed' => '確認用パスワードがちがうお！！',

        ];
    }
}
