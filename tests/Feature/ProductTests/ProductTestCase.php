<?php

namespace Tests\Feature\ProductTests;

use Tests\TestCase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTestCase extends TestCase {
    use RefreshDatabase, RegistersProductService;
	
    /**
     * Image base folder
     * 
     * @var string
     */
    protected $imagesBaseFolder = '/images/product-images/';
	
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
		
        $this->fixtures 	= include('tests/Fixtures/productData.php');
        $this->invalidId	= Config::get('app.seeder_quantity') + 1;
    }
}
