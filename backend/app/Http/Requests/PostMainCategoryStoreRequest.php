<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostMainCategoryStoreRequest extends FormRequest
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
            'main_category' => ['required','string','max:100','unique:post_main_categories'],
            //
        ];
    }

    public function messages() {

        return [
            'main_category.required' => 'メインカテゴリーは必須だお',
            'main_category.string' => 'メインカテゴリーは文字列の必要があるよ',
            'main_category.max' => '100文字以下にしてね',
            'main_category.unique' => 'そのメインカテゴリーはもう登録されているよ',
        ];
    }
}
