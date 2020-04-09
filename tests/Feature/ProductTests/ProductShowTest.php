<?php

namespace Tests\Feature\ProductTests;

use App\Http\Resources\ProductResources\ProductResource;

class ProductShowTest extends ProductTestCase {
    /**
     * Test product show
     *
     * @return void
     */
    public function testShowProduct(): void {
        $productId		= 1;
        $product		= $this->productService->find($productId);
        $route 			= self::BASE_URL . $productId;
        $response 		= $this->get($route);
        $expectedJson 	= json_encode(new ProductResource($product));

        $response->assertStatus(200)
				->assertSee($expectedJson, $escaped = false);
    }
	
    /**
     * Test product show with nonexistent id
     *
     * @return void
     */
    public function testShowNonexistentProduct(): void {
        $route 			= self::BASE_URL . $this->invalidId;
        $response 		= $this->get($route);
        $expectedJson	= [
			'message' => 'This product could not be found.'
		];

        $response->assertStatus(404)
				->assertJson($expectedJson);
    }
}
