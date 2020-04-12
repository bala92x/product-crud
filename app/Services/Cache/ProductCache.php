<?php

namespace App\Services\Cache;

use Illuminate\Support\Facades\Cache;

use App\Models\Product;
use App\Services\ProductService;
use App\Services\Interfaces\ProductServiceInterface;

class ProductCache extends BaseCache implements ProductServiceInterface {
    /**
     * ProductCache constructor.
     * 
	 * @param Product $model
	 * @param ProductService $service
     * @return void
     */
    public function __construct(Product $model, ProductServiceInterface $service) {
        parent::__construct($model, $service);
    }
	
    /**
     * Delete the product files folder.
     *
     * @return bool
     */
    public function deleteAllFiles(): bool {
        Cache::flush();
		
        return $this->service->deleteAllFiles();
    }
}