<?php

namespace App\Services\Cache;

use Illuminate\Support\Facades\Cache;

use App\Models\Product;
use App\Services\Interfaces\ProductServiceInterface;

class ProductCache extends BaseCache implements ProductServiceInterface {
    /**
     * ProductCache constructor.
     * 
	 * @param Product $model
	 * @param ProductServiceInterFace $service
     * @return void
     */
    public function __construct(Product $model, ProductServiceInterface $service) {
        parent::__construct($model, $service);
    }
	
    /**
     * Delete the product images folder.
     *
     * @return bool
     */
    public function deleteAllImages(): bool {
        Cache::flush();
		
        return $this->service->deleteAllImages();
    }
}