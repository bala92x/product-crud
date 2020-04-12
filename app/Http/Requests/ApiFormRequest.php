<?php

namespace App\Http\Requests;

class ApiFormRequest extends BaseFormRequest {
    /**
     * The data to be validated should be processed as JSON.
     * @return mixed
     */
    public function validationData() {
        return $this->json()->all();
    }
}