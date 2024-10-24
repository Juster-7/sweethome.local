<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use App\Traits\Api\SendResponse;

class ProductStoreRequest extends FormRequest
{
	use SendResponse;
	
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'title' => 'required|max:255',
            'price' => 'required|decimal:0,2',
            'product_category_id' => 'required|integer|exists:product_categories,id',
            'brand_id' => 'required|integer|exists:brands,id',
        ];
    }
	
	public function failedValidation(Validator $validator) {
		throw new HttpResponseException(
			$this->sendError('Validation Error', $validator->errors(), 400)
		);
	}
}
