<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class PostCategoryCreateRequest extends FormRequest
{
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'title' => 'required|min:5|max:255',
            'css_color' => 'required'
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
