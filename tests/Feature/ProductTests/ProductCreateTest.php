<?php

namespace Tests\Feature\ProductTests;

use Illuminate\Support\Facades\Storage;

use App\Http\Resources\ProductResources\ProductResource;

class ProductCreateTest extends ProductTestCase {
    /**
     * Base url
     * 
     * @var string
     */
    const BASE_URL = '/api/products/store/';
	
    /**
     * Test create product
     *
     * @return void
     */
    public function testCreateProduct(): void {
        $route 			= self::BASE_URL;
        $response 		= $this->post($route, $this->fixtures['productCreateData']);
        $productId 		= json_decode($response->getContent())->data->id;
        $product		= $this->productService->find($productId);
        $expectedJson 	= json_encode(new ProductResource($product));
		
        $response->assertStatus(201)
				->assertSee($expectedJson, $escaped = false);
		
        Storage::disk('public')->assertExists($product->image_path);
    }

    /**
     * Test validation errors
     *
     * @return void
     */
    public function testValidationErrors(): void {
        $initialProductCount 	= $this->productService->count();
        $route 					= self::BASE_URL;
        $response 				= $this->post($route, $this->fixtures['productInvalidData']);
        $expectedErrors			= json_encode([
			'publishedUntil'				=> [
				'The published until must be a date after published at.'
			],
			'price'							=> [
				'The price must be an integer.'
			],
			'image'							=> [
				'The image field is required when product id is not present.'
			],
			'productTranslations.1.slug'	=> [
				'The product translation slug has already been taken.'
			],
			'productTagIds.0'				=> [
				'The product tag id must be an integer.'
			]
		]);

        $this->assertEquals($initialProductCount, $this->productService->count());
        $response->assertStatus(422)
				->assertSee($expectedErrors, $ecaped = false);

        $imageFolder = self::IMAGES_BASE_FOLDER . ($initialProductCount + 1);
		
        Storage::disk('public')->assertMissing($imageFolder);
    }
}
