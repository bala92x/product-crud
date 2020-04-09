<?php

namespace Tests\Feature\ProductTests;

use App\Services\Interfaces\ProductServiceInterface;

trait RegistersProductService {
    /**
	 * The service used to manage products.
	 * 
     * @var ProductService 
     */
    protected $productService;
	
    /**
     * Register the product service.
     *
     * @return void
     */
    protected function registerProductService(): void {
        $this->productService = app()->make(ProductServiceInterface::class);
    }
}