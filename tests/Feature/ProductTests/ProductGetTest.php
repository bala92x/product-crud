<?php

namespace Tests\Feature\ProductTests;

use Tests\TestCase;
use Illuminate\Support\Facades\Config;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Product;
use App\Services\ProductService;
use App\Http\Resources\ProductResources\ProductResource;

/**
 * Class ProductGetTest
 * 
 * @package Tests\Feature\ProductTests
 */
class ProductGetTest extends TestCase {
    use RefreshDatabase;
	
    /**
     * @var ProductService 
     */
    private $productService;
	
    /**
     * Set up testing environment.
     *
	 * @return void
     */
    public function setUp(): void {
        parent::setUp();
		
        $this->seed();
		
        $this->productService = new ProductService(new Product());
    }
	
    /**
     * Test get product
     *
     * @return void
     */
    public function testGetProduct(): void {
        $productId		= 1;
        $product		= $this->productService->find($productId);
        $route 			= '/api/products/' . $productId;
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
    public function testGetNonexistentId(): void {
        $productId	= Config::get('app.seeder_quantity') + 1;
        $route 		= '/api/products/' . $productId;
        $response 	= $this->get($route);

        $response->assertStatus(404);
    }
}
