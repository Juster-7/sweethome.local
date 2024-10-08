<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SearchRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'search' => 'bail|required|string|min:2|max:200'
        ];
    }
	/*
	protected function failedValidation(Validator $validator) {
		throw new HttpResponseException(redirect()->route('search')->withErrors($validator));
		//return abort(404);
	}
	*/
}
