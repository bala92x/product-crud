<?php

namespace Tests\Feature\ProductTests;

use Tests\TestCase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Product;

class ProductTestCase extends TestCase {
    use RefreshDatabase, RegistersProductService;
	
    /**
     * Base url
     * 
     * @var string
     */
    const BASE_URL = '/api/products/';
	
    /**
     * Files base folder
     * 
     * @var string
     */
    const FILES_BASE_FOLDER = 'products';
	
    /**
     * The data needed to create or update a product.
     * 
     * @var array
     */
    protected $fixtures;
	
    /**
     * A nonexistent product id
     * 
     * @var int
     */
    protected $invalidId;
	
    /**
     * Set up testing environment.
     *
     * @return void
     */
    public function setUp(): void {
        parent::setUp();
        Storage::fake('public');
		
        $this->seed();
        $this->registerProductService();
		
        $this->fixtures 	= require __DIR__ . '/../../Fixtures/productData.php';
        $this->invalidId	= Config::get('app.seeder_quantity') + 1;
    }
	
    /**
     * Assert that all properties and relations are saved properly.
     * 
     * @param Product $product
	 * @param array $fixtures 
     * @return void
     */
    protected function assertDataSaved(Product $product, array $fixtures): void {
        $this->assertEquals(
			$this->sanitizeData($product->toArray()),
			$this->sanitizeData($fixtures)
		);

        foreach ($fixtures['productTranslations'] as $key => $translation) {
            $this->assertEquals(
				$this->sanitizeData($translation),
				$this->sanitizeData(
					$product->productTranslations
							->where('slug', $translation['slug'])
							->first()
							->toArray()
				)
			);
        }
		
        $this->assertEquals(
			$product->productTags->pluck('id')->toArray(),
			$fixtures['productTagIds']
		);
    }
}
