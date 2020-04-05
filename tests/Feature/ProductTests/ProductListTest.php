<?php

namespace Tests\Feature\ProductTests;

use Tests\TestCase;
use Illuminate\Support\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Product;
use App\Services\ProductService;
use App\Http\Resources\ProductResources\ProductCollection;

/**
 * Class ProductListTest
 * 
 * @package Tests\Feature\ProductTests
 */
class ProductListTest extends TestCase {
    use RefreshDatabase;
	
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
		
        $productService = new ProductService(new Product());
        $this->products = $productService->all();
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
