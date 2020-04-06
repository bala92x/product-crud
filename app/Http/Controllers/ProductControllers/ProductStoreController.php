<?php

namespace App\Http\Controllers\ProductControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

use App\Http\Requests\ProductRequests\StoreProductRequest;
use App\Services\Interfaces\ProductServiceInterface;
use App\Services\ProductService;

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
	 * @param StoreProductRequest $request
	 * @param string $productId
     * @return JsonResponse
     */
    public function store(StoreProductRequest $request, string $productId = null): JsonResponse {
        // TODO: implement
        return response()->json([
			'method' => 'ProductStoreController@store'
		]);
    }
}
