<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class AddCommentRequest extends FormRequest
{
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'post_id' => 'required|integer|exists:posts,id',
            'user_id' => 'required|integer|exists:users,id',
			'text' => 'required|max:250',
			'parent_id' => 'nullable|integer|exists:comments,id',
        ];
    }
	
	public function failedValidation(Validator $validator) {
		throw new HttpResponseException(
			back()->withInput()->withErrors($validator->errors())->withFragment('#add_comment')
		);
	}
	
	public function messages() {
        return [
			'text.required' => 'Текст комментария должен быть заполнен',
			'text.max' => 'Длина комментария не должна превышать 250 символов',
        ];
    }
}
