<?php

namespace Tests\Feature\ProductTests;

use Illuminate\Support\Collection;

use App\Http\Resources\ProductResources\ProductCollection;

class ProductIndexTest extends ProductTestCase {
    /**
	 * All products.
	 * 
     * @var Collection 
     */
    private $products;
	
    /**
     * Set up testing environment.
     *
	 * @return void
     */
    public function setUp(): void {
        parent::setUp();
		
        $this->products = $this->productService->all();
    }
	
    /**
     * Test products index
     *
     * @return void
     */
    public function testProductsIndex(): void {
        $route 			= self::BASE_URL;
        $response 		= $this->get($route);
        $expectedJson 	= json_encode(new ProductCollection($this->products));

        $response->assertStatus(200)
				->assertSee($expectedJson, $escaped = false);
    }
}
