<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use App\Traits\Api\HasSendResponse;

class UserRegisterRequest extends FormRequest
{
	use HasSendResponse;
	
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ];
    }
	
	public function failedValidation(Validator $validator) {
		throw new HttpResponseException(
			$this->sendError('Validation Error', $validator->errors(), 400)
		);
	}
}
