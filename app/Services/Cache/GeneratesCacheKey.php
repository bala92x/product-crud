<?php

namespace App\Services\Cache;

use Illuminate\Support\Facades\Config;

trait GeneratesCacheKey {
    /**
     * Generate cache key
     * 
     * @param array $fragments
	 * @return string
     */
    protected function generateCacheKey(array $fragments = []): string {
        $appPrefix 		= Config::get('cache.prefix');
        $modelName 		= strtolower(class_basename($this->model));
        $fragmentsKey	= implode('_', $fragments);

        return implode('_',  [$appPrefix, $modelName, $fragmentsKey]);
    }
}