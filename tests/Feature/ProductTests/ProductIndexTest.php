<?php

namespace Tests\Feature\ProductTests;

use Illuminate\Testing\TestResponse;

use App\Http\Resources\ProductResources\ProductCollection;

class ProductIndexTest extends ProductTestCase {
    /**
     * Test products index
     * 
     * @return void
     */
    public function testProductsIndex(): void {
        $page				= null;
        $limit				= null;
        $route 				= self::BASE_URL;
        $response 			= $this->get($route);
        $products 			= $this->productService->paginated($page, $limit);
        $expectedJson 		= json_encode(new ProductCollection($products));
		
        $this->assertPaginationWorks($response);

        $response->assertStatus(200)
				->assertSee($expectedJson, $escaped = false);
    }

    /**
     * Test products index
     *
     * @return void
     */
    public function testProductsIndexPaginated(): void {
        $page 				= 2;
        $limit				= 1;
        $route 				= self::BASE_URL . '?limit=' . $limit . '&page=' . $page;
        $response 			= $this->get($route);
        $products 			= $this->productService->paginated($page, $limit);
        $expectedJson 		= json_encode(new ProductCollection($products));
		
        $this->assertPaginationWorks($response, $page, $limit);

        $response->assertStatus(200)
				->assertSee($expectedJson, $escaped = false);
    }
	
    /**
     * Assert pagination works
     *
	 * @param TestResponse $response
	 * @param int $page
	 * @param int $limit
     * @return void
     */
    private function assertPaginationWorks(TestResponse $response, $page = 1, $limit = null) {
        if (is_null($limit)) {
            $limit = $this->productService->count();
        }
		
        $responseContent = json_decode($response->getContent());
		
        $this->assertEquals($responseContent->meta->current_page, $page);
        $this->assertEquals($responseContent->meta->per_page, $limit);
		
        unset($responseContent->links);
        unset($responseContent->meta);
		
        $response->setContent(json_encode($responseContent));
    }
}
