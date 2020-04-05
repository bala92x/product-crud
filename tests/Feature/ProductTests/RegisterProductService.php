<?php

namespace Tests\Feature\ProductTests;

use App\Models\Product;
use App\Services\ProductService;

/**
 * Trait RegisterProductService
 * 
 * @package Tests\Feature\ProductTests
 */
trait RegisterProductService {
    /**
     * @var ProductService 
     */
    private $productService;
	
    /**
     * Register the product service
     *
     * @return void
     */
    protected function registerProductService(): void {
        $this->productService = new ProductService(new Product());
    }
}