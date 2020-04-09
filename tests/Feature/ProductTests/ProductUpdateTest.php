<?php

namespace Tests\Feature\ProductTests;

use Illuminate\Support\Facades\Storage;

use App\Http\Resources\ProductResources\ProductResource;

class ProductUpdateTest extends ProductTestCase {
    /**
     * Test product update
     *
     * @return void
     */
    public function testUpdateProduct(): void {
        $productId			= 1;
        $initialImagePath	= $this->productService->find($productId)->image_path;
        $route 				= self::BASE_URL . $productId;
        $response 			= $this->post($route, $this->fixtures['productUpdateData']);
        $product			= $this->productService->find($productId);
        $expectedJson 		= json_encode(new ProductResource($product));
		
        $response->assertStatus(200)
			->assertSee($expectedJson, $escaped = false);
			
        $this->assertDataSaved($product, $this->fixtures['productUpdateData']);

        Storage::disk('public')->assertMissing($initialImagePath);
        Storage::disk('public')->assertExists($product->image_path);
    }

    /**
     * Test validation errors
     *
     * @return void
     */
    public function testValidationErrors(): void {
        $productId		= 1;
        $initialProduct	= $this->productService->find($productId);
        $route 			= self::BASE_URL . $productId;
        $response 		= $this->post($route, $this->fixtures['productInvalidData']);
        $expectedErrors	= json_encode([
			'publishedUntil'	=> [
				'The published until must be a date after published at.'
			],
			'price'				=> [
				'The price must be an integer.'
			],
			'image'				=> [
				'The image must be an image.'
			],
			'productTagIds.0' => [
				'The product tag id must be an integer.'
			]
		]);

        $response->assertStatus(422)
				->assertSee($expectedErrors, $ecaped = false);
        $this->assertTrue($initialProduct->is($this->productService->find($productId)));

        Storage::disk('public')->assertExists($initialProduct->image_path);
    }
	
    /**
     * Test product update with nonexistent id
     *
     * @return void
     */
    public function testNotFound(): void {
        $productId		= $this->invalidId;
        $route 			= self::BASE_URL . $productId;
        $response 		= $this->post($route, $this->fixtures['productUpdateData']);
        $expectedJson	= [
			'message' => 'This product could not be found.'
		];

        $response->assertStatus(404)
				->assertJson($expectedJson);
				
        Storage::disk('public')->assertMissing(self::IMAGES_BASE_FOLDER . $productId);
    }
}
