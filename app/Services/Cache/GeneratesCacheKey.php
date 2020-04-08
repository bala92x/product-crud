<?php

namespace App\Services\Cache;

use Illuminate\Support\Facades\Config;

trait GeneratesCacheKey {
    /**
     * Generate cache key
     * 
     * @param array $keys
	 * @return string
     */
    protected function generateCacheKey(array $keys = []): string {
        $appPrefix 	= Config::get('cache.prefix');
        $modelName 	= strtolower(class_basename($this->model));
        $argsKey	= implode('_', $keys);

        return implode('_',  [$appPrefix, $modelName, $argsKey]);
    }
}