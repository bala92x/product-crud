<?php

namespace Tests\Feature\ProductTests;

use Tests\TestCase;
use Illuminate\Support\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Http\Resources\ProductResources\ProductCollection;

/**
 * Class ProductListTest
 * 
 * @package Tests\Feature\ProductTests
 */
class ProductListTest extends TestCase {
    use RefreshDatabase, RegisterProductService;
	
    /**
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

        $this->seed();
        $this->registerProductService();
		
        $this->products = $this->productService->all();
    }
	
    /**
     * Test list all products
     *
     * @return void
     */
    public function testListAllProducts(): void {
        $route 			= '/api/products/';
        $response 		= $this->get($route);
        $expectedJson 	= json_encode(new ProductCollection($this->products));

        $response->assertStatus(200)
				->assertSee($expectedJson, $escaped = false);
    }
}
