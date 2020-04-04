<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Services\Interfaces\ProductServiceInterface;
use App\Services\ProductService;

/**
 * Class ProductStoreController
 *
 * @package App\Http\Controllers\Product
 */
class ProductStoreController extends Controller {
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
     * Create or update a product.
     * 
	 * @param Request $request
	 * @param string $productId
     * @return JsonResponse
     */
    public function store(Request $request, string $productId = null): JsonResponse {
        // TODO
        return response()->json([
			'method' => 'ProductStoreController@store'
		]);
    }
}
