<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditAdministratorPrivileges extends FormRequest
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
            'firstname_kanji' => ['required','string','max:30'],
            'lastname_kanji' => ['required','string','max:30'],
            'firstname_kana' => ['required','string','max:30'],
            'lastname_kana' => ['required','string','max:30'],
            'email' => ['required','email','unique:users','max:100'],
            'birthday_year' => ['required','string','min:4','max:4'],
            'birthday_month' => ['required','string','min:2','max:2'],
            'birthday_day' => ['required', 'string','min:2','max:2'],
            'Admission_year' => ['required','string','min:4','max:4'],
            'Admission_month' => ['required','string','min:2','max:2'],
            'Admission_day' => ['required', 'string','min:2','max:2'],
            'gender' => ['required'],
            'role' => ['required'],
            'password_confirmed' => ['same:password'],
            'password' => ['required','string','max:30','min:8','same:password_confirmed'],
        ];
    }
    public function messages()
    {
        return [
            'firstname_kanji.required' => 'ユーザー名(姓)は必須です。',
            'lastname_kanji.required' => 'ユーザー名(名)は必須です。',
            'firstname_kana.required' => 'ユーザー名(セイ)は必須です。',
            'lastname_kana.required' => 'ユーザー名(メイ)は必須です。',

            'birthday_year.required' => '生年月日は必須です。',
            'birthday_month.required' => '生年月日は必須です。',
            'birthday_day.required' => '生年月日は必須です。',
            'birthday_year.min' => '生年月日はyyyy/mm/ddの形式で入力してください。',
            'birthday_year.max' => '生年月日はyyyy/mm/ddの形式で入力してください。',
            'birthday_month.min' => '生年月日はyyyy/mm/ddの形式で入力してください。',
            'birthday_month.max' => '生年月日はyyyy/mm/ddの形式で入力してください。',
            'birthday_day.min' => '生年月日はyyyy/mm/ddの形式で入力してください。',
            'birthday_day.max' => '生年月日はyyyy/mm/ddの形式で入力してください。',

            'Admission_year.required' => '入学日は必須です。',
            'Admission_month.required' => '入学日は必須です。',
            'Admission_day.required' => '入学日は必須です。',
            'Admission_year.min' => '入学日はyyyy/mm/ddの形式で入力してください。',
            'Admission_year.max' => '入学日はyyyy/mm/ddの形式で入力してください。',
            'Admission_month.min' => '入学日はyyyy/mm/ddの形式で入力してください。',
            'Admission_month.max' => '入学日はyyyy/mm/ddの形式で入力してください。',
            'Admission_day.min' => '入学日はyyyy/mm/ddの形式で入力してください。',
            'Admission_day.max' => '入学日はyyyy/mm/ddの形式で入力してください。',

            'gender.required' => 'どちらか選択してください。',

            'email.required' => 'メールアドレスは必須です',
            'email.email' => 'メールアドレス形式の必要があります',
            'email.unique' => 'すでに登録済みのメールアドレスです。',
            'email.max' => 'メールアドレスは最大30文字です。',
            'password.required' => 'パスワードを入力してください',
            'password.min' => 'パスワードは最低8文字の必要があります。',
            'password.max' => 'パスワードは最大30文字の必要があります。',
            'password.confirmed' => '確認用パスワードが一致しません。',

            'role.required' => '権限は必須です。'

        ];
    }
}