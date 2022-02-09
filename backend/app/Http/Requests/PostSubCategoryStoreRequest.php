<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostSubCategoryStoreRequest extends FormRequest
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
            'sub_category' =>['required','string','max:100','unique:post_sub_categories'],
            'post_main_category_id' => ['required'],
            //
        ];
    }

    public function messages() {

        return [
             'sub_category.required' => 'サブカテゴリーはひっすだよ',
        'sub_category.string' => '文字列の必要があるよ',
        'sub_category.max' => '最大100もじだよ',
        'sub_category.unique' => 'すでに登録されているよ',
        'post_main_category_id.required' => 'メインカテゴリーの選択は必須だよ',
        ];
    }
}
