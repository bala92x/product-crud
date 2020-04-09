<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;

class ApiRequest extends Request {
    /**
     * Determine if the current request probably expects a JSON response.
     *
     * @return bool
     */
    public function expectsJson(): bool {
        if (env('APP_DEBUG')) {
            return parent::expectsJson();
        }

        return true;
    }

    /**
     * Determine if the current request is asking for JSON.
     *
     * @return bool
     */
    public function wantsJson(): bool {
        if (env('APP_DEBUG')) {
            return parent::wantsJson();
        }
		
        return true;
    }
}	