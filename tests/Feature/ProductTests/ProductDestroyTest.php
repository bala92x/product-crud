<?php

namespace Tests\Feature\ProductTests;

use Illuminate\Support\Facades\Storage;

class ProductDestroyTest extends ProductTestCase {
    /**
     * Test product destroy
     *
     * @return void
     */
    public function testDestroyProduct(): void {
        $productId		= 1;
        $route 			= self::BASE_URL . $productId;
		
        Storage::disk('public')->assertExists(self::IMAGES_BASE_FOLDER . $productId);
		
        $response = $this->delete($route);
		
        $response->assertNoContent(204);
        $this->assertProductDestroyed($productId);
    }
	
    /**
     * Test product destroy with nonexistent id
     *
     * @return void
     */
    public function testDestroyNonexistentProduct(): void {
        $route 		= self::BASE_URL . $this->invalidId;
        $response 	= $this->delete($route);

        $response->assertNoContent(204);
    }
	
    /**
     * Assert that the product and all its relations are destroyed.
     *
     * @return void
     */
    public function assertProductDestroyed(int $productId): void {
        $this->assertSoftDeleted('products', ['id' => $productId]);
        $this->assertSoftDeleted('product_translations', ['product_id' => $productId]);
        $this->assertDatabaseMissing('products_product_tags', ['product_id' => $productId]);
        Storage::disk('public')->assertMissing(self::IMAGES_BASE_FOLDER . $productId);
    }
}
