<?php

namespace App\Http\Controllers\ProductControllers;

use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

use App\Services\ProductService;
use App\Services\Interfaces\ProductServiceInterface;

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
	 * 
	 * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function delete(string $productId): Response {
        try {
            $this->productService->delete($productId);
			
            return response(null, 204);
        } catch (Exception $e) {
            abort(500, 'Product delete error.');
        }
    }
}
