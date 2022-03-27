<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditUserProfile extends FormRequest
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
            //
            'password_confirmed' => ['same:password'],
            'password' => ['required','string','max:30','min:8','same:password_confirmed'],
        ];
    }

    public function messages()
    {
        return [

            'password.required' => 'プロフィールを変更する際はパスワードを入力してください。',
            'password.min' => 'パスワードは最低8文字の必要があります。',
            'password.max' => 'パスワードは最大30文字の必要があります。',
            'password.confirmed' => '確認用パスワードが一致しません。',

            'role.required' => '権限は必須です。'

        ];
}