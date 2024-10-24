<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageUploadRequest extends FormRequest
{
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
			'profilephoto' => 'required|mimes:jpeg,jpg,png|max:2000'
        ];
    }

	public function messages() {
        return [
			'profilephoto.max' => 'Загружаемое фото должно быть не больше 2МБ',
        ];
    }
}
