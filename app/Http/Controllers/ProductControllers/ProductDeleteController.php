<?php

namespace App\Http\Controllers\ProductControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

use App\Services\Interfaces\ProductServiceInterface;
use App\Services\ProductService;

class ProductDeleteController extends Controller {
    /**
     * @var ProductService 
     */
    private $productService;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProductServiceInterface $productService) {
        $this->productService = $productService;
    }
	
    /**
     * Delete a product.
     * 
	 * @param string $productId
     * @return Response
     */
    public function delete(string $productId): Response {
        $this->productService->delete($productId);
		
        return response(null, 204);
    }
}
