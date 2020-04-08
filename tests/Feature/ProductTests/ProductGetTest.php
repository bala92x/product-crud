<?php

namespace Tests\Feature\ProductTests;

use App\Http\Resources\ProductResources\ProductResource;

class ProductGetTest extends ProductTestCase {
    /**
     * Base url
     * 
     * @var string
     */
    const BASE_URL = '/api/products/';
	
    /**
     * Test get product
     *
     * @return void
     */
    public function testGetProduct(): void {
        $productId		= 1;
        $product		= $this->productService->find($productId);
        $route 			= self::BASE_URL . $productId;
        $response 		= $this->get($route);
        $expectedJson 	= json_encode(new ProductResource($product));

        $response->assertStatus(200)
				->assertSee($expectedJson, $escaped = false);
    }
	
    /**
     * Test get product with nonexistent id
     *
     * @return void
     */
    public function testGetNonexistentProduct(): void {
        $route 		= self::BASE_URL . $this->invalidId;
        $response 	= $this->get($route);

        $response->assertStatus(404);
    }
}
