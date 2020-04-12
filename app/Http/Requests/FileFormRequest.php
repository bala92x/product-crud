<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Config;

class FileFormRequest extends BaseFormRequest {
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array {
        $validationRules = [
            'file' 		=> [
				'required',
				'file',
				'max:' . Config::get('app.upload_max_filesize'),
			],
			'module'	=> [
				'required',
				Rule::in(Config::get('app.modules'))
			],
		];
		
        if ($this->module === 'products') {
            array_push($validationRules['file'], 'image');
        }
		
        return $validationRules;
    }
	
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array {
        return [
    		'module.in' => 'There selected module does not exist.',
    	];
    }
}
