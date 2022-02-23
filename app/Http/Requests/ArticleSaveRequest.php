<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ArticleSaveRequest extends FormRequest
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
            'title' => 'required|max:100|min:2',
            'body' => 'required|max:5000|min:2',
            'img_1' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'img_1__remove' => 'in:Y',
        ];
    }
}
