<?php

namespace Tests\Feature\ProductTests;

use Illuminate\Support\Facades\Storage;

class ProductDeleteTest extends ProductTestCase {
    /**
     * Test delete product
     *
     * @return void
     */
    public function testDeleteProduct(): void {
        $productId		= 1;
        $route 			= self::BASE_URL . $productId;
		
        Storage::disk('public')->assertExists(self::IMAGES_BASE_FOLDER . $productId);
		
        $response = $this->delete($route);
		
        $response->assertNoContent(204);
        $this->assertProductDeleted($productId);
    }
	
    /**
     * Test delete product with nonexistent id
     *
     * @return void
     */
    public function testDeleteNonexistentProduct(): void {
        $route 		= self::BASE_URL . $this->invalidId;
        $response 	= $this->delete($route);

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
        Storage::disk('public')->assertMissing(self::IMAGES_BASE_FOLDER . $productId);
    }
}
