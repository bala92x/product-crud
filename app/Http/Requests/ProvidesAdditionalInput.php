<?php

namespace App\Http\Requests;

trait ProvidesAdditionalInput {
    /**
     * Get data to be validated from the request.
     *
     * @return array
     */
    public function validationData(): array {
        $input = array_merge(parent::validationData(), $this->additionalInput());
        $this->replace($input);

        return $input;
    }

    /**
     * Return additional request data.
     *
     * @return array
     */
    protected function additionalInput(): array {
        if (property_exists($this, 'additionalInput')) {
            return $this->additionalInput;
        }

        return [];
    }
}