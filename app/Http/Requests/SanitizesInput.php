<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Contracts\Validation\Validator;

trait SanitizesInput {
    /**
     * Configure the validator instance.
     *
     * @param Validator $validator
     * @return void
     */
    public function withValidator(Validator $validator): void {
        $validator->after(function() {
            $this->sanitizeAfterValidationPassed();
        });
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function sanitizeAfterValidationPassed(): void {
        $sanitized = $this->sanitizeKeys($this->all());
        $this->replace($sanitized);
    }
	
    /**
     * Sanitize request data.
     * 
     * @param array $toSanitize
     * @return array
     */
    private function sanitizeKeys(array $toSanitize): array {
        $sanitized = [];

        foreach ($toSanitize as $key => $param) {
            if (is_array($param)) {
                $param = $this->sanitizeKeys($param);
            }
            $sanitized[Str::snake($key)] = $param;
        }
		
        return $sanitized;
    }
}