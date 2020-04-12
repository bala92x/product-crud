<?php

namespace Tests\Feature\ProductTests;

use Illuminate\Support\Facades\Storage;

use Tests\Feature\UploadsFile;
use App\Http\Resources\ProductResources\ProductResource;

class ProductStoreTest extends ProductTestCase {
    use UploadsFile;

    /**
     * Test product store
     *
     * @return void
     */
    public function testStoreProduct(): void {
        $initialProductCount = $this->productService->paginated(null, null)->count();
        $this->assertEquals($initialProductCount, $this->productService->count());
		
        $this->fixtures['productStoreData']['imagePath'] = $this->uploadFile('products', 'image');

        $route 			= self::BASE_URL;
        $response 		= $this->postJson($route, $this->fixtures['productStoreData']);
        $productId 		= json_decode($response->getContent())->data->id;
        $product		= $this->productService->find($productId);
        $expectedJson 	= json_encode(new ProductResource($product));
		
        $response->assertStatus(201)
				->assertSee($expectedJson, $escaped = false);
        $this->assertDataSaved($product, $this->fixtures['productStoreData']);
		
        $this->assertEquals($this->productService->paginated(null, null)->count(), $initialProductCount + 1);
        $this->assertEquals($this->productService->count(), $initialProductCount + 1);
		
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
        $response 				= $this->postJson($route, $this->fixtures['productInvalidData']);
        $expectedErrors			= json_encode([
			'publishedUntil'				=> [
				'The published until must be a date after published at.'
			],
			'price'							=> [
				'The price must be an integer.'
			],
			'imagePath'						=> [
				'The file specified for image path does not exist.'
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
    }
}
