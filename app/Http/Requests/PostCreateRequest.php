<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class PostCreateRequest extends FormRequest
{
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'meta_description' => 'nullable',
			'meta_keyword' => 'nullable',
			'post_category_id' => 'required|exists:post_categories,id',
			'user_id' => 'required|exists:users,id',
			'title' => 'required|min:5|max:255',
			'intro_text' => 'nullable',
			'main_text' => 'nullable',
			'date_show' => 'required'
        ];
    }
		
	public function messages() {
        return [
			'title.required' => 'Название категории должно быть заполнено',
			'title.min' => 'Название категории не должно быть меньше 5 символов',
			'title.max' => 'Название категории не должно превышать 255 символов',
        ];
    }
}
