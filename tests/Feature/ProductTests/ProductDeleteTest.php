<?php

namespace Tests\Feature\ProductTests;

use Tests\TestCase;
use Illuminate\Support\Facades\Config;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductDeleteTest extends TestCase {
    use RefreshDatabase;
	
    /**
     * Set up testing environment.
     *
	 * @return void
     */
    public function setUp(): void {
        parent::setUp();
		
        $this->seed();
    }
	
    /**
     * Test delete product
     *
     * @return void
     */
    public function testDeleteProduct(): void {
        $productId		= 1;
        $route 			= '/api/products/delete/' . $productId;
        $response 		= $this->delete($route);

        $response->assertNoContent(204);
        $this->assertProductDeleted($productId);
    }
	
    /**
     * Test delete product with nonexistent id
     *
     * @return void
     */
    public function testDeleteNonexistentProduct(): void {
        $productId		= Config::get('app.seeder_quantity') + 1;
        $route 			= '/api/products/delete/' . $productId;
        $response 		= $this->delete($route);

        $response->assertNoContent(204);
    }
	
    /**
     * Assert that the product and all its relations are deleted.
     *
     * @return void
     */
    public function assertProductDeleted(int $productId): void {
        $this->assertSoftDeleted('products', ['id' => $productId]);
        $this->assertSoftDeleted('product_translations', ['product_id' => $productId]);
        $this->assertDatabaseMissing('products_product_tags', ['product_id' => $productId]);
		
        // TODO: assert that the image is deleted
    }
}