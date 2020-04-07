<?php

namespace Tests\Feature\ProductTests;

use Illuminate\Support\Collection;

use App\Http\Resources\ProductResources\ProductCollection;

class ProductListTest extends ProductTestCase {
    /**
     * Base url
     * 
     * @var string
     */
    private $baseUrl = '/api/products/';
	
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
     * Test list all products
     *
     * @return void
     */
    public function testListAllProducts(): void {
        $route 			= $this->baseUrl;
        $response 		= $this->get($route);
        $expectedJson 	= json_encode(new ProductCollection($this->products));

        $response->assertStatus(200)
				->assertSee($expectedJson, $escaped = false);
    }
}
