<?php

namespace App\Http\Requests\BulletinBoard;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;//追加

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
    // ▼追加
    public function rules()
    {
        return [
            'post_category_id' => 'required|exists:sub_categories,id',
            'post_title' => 'required|string|max:100',
            'post_body' => 'required|string|max:5000',
        ];
    }
    // ▼追加
    public function messages(){
        return [
            'post_title.max' => '※タイトルは100文字以内で記入してください。',
            'post_body.max' => '※投稿内容は最大文字数5000文字です。',
        ];
    }
}
