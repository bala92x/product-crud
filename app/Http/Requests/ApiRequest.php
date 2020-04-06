<?php

namespace App\Http\Requests;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class ApiRequest extends FormRequest {
    use SanitizesInput;
	
    /**
     * Throw JSON in case of failed validation.
	 * 
	 * @return HttpResponseException
     */
    protected function failedValidation(Validator $validator): HttpResponseException {
        $content = [
			'message' 	=> 'The given data was invalid.',
			'errors'	=> $validator->errors()
		];

        throw new HttpResponseException(response($content, 422));
    }
}	