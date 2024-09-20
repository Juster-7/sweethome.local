<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
//use Illuminate\Support\Facades\Validator;

class AddCommentRequest extends FormRequest
{
	//use Validator;
	/*
	protected function failedValidation(Validator $validator) {
		return redirect()->route('post.add_comment', ['slug' => $post->slug])->withInput()->withErrors($validator->errors());
	}
	*/
	
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
            'post_id' => 'required|numeric',
			'name' => 'required|alpha|max:100',
			'email' => 'required|email',
			'text' => 'required|max:250',
			'parent_id' => 'numeric|nullable',
        ];
    }
}
