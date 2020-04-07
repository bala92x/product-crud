<?php

namespace Tests\Feature\ProductTests;

use App\Http\Resources\ProductResources\ProductResource;

class ProductGetTest extends ProductTestCase {
    /**
     * Base url
     * 
     * @var string
     */
    private $baseUrl = '/api/products/';
	
    /**
     * Test get product
     *
     * @return void
     */
    public function testGetProduct(): void {
        $productId		= 1;
        $product		= $this->productService->find($productId);
        $route 			= $this->baseUrl . $productId;
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
        $route 		= $this->baseUrl . $this->invalidId;
        $response 	= $this->get($route);

        $response->assertStatus(404);
    }
}
