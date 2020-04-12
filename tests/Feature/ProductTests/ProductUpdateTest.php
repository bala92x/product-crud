<?php

namespace Tests\Feature\ProductTests;

use Tests\Feature\UploadsFile;
use App\Http\Resources\ProductResources\ProductResource;

class ProductUpdateTest extends ProductTestCase {
    use UploadsFile;
	
    /**
     * Test product update
     *
     * @return void
     */
    public function testUpdateProduct(): void {
        $this->fixtures['productUpdateData']['imagePath'] = $this->uploadFile('products', 'image');

        $productId			= 1;
        $route 				= self::BASE_URL . $productId;
        $response 			= $this->patchJson($route, $this->fixtures['productUpdateData']);
        $product			= $this->productService->find($productId);
        $expectedJson 		= json_encode(new ProductResource($product));
		
        $response->assertStatus(200)
			->assertSee($expectedJson, $escaped = false);
			
        $this->assertDataSaved($product, $this->fixtures['productUpdateData']);
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
        $response 		= $this->patchJson($route, $this->fixtures['productInvalidData']);
        $expectedErrors	= json_encode([
			'publishedUntil'	=> [
				'The published until must be a date after published at.'
			],
			'price'				=> [
				'The price must be an integer.'
			],
			'imagePath'			=> [
				'The file specified for image path does not exist.'
			],
			'productTagIds.0' 	=> [
				'The product tag id must be an integer.'
			]
		]);

        $response->assertStatus(422)
				->assertSee($expectedErrors, $ecaped = false);
        $this->assertTrue($initialProduct->is($this->productService->find($productId)));
    }
	
    /**
     * Test product update with nonexistent id
     *
     * @return void
     */
    public function testNotFound(): void {
        $productId		= $this->invalidId;
        $route 			= self::BASE_URL . $productId;
        $response 		= $this->patchJson($route, $this->fixtures['productUpdateData']);
        $expectedJson	= [
			'message' => 'This product could not be found.'
		];

        $response->assertStatus(404)
				->assertJson($expectedJson);
    }
}
