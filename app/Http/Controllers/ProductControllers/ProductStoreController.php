<?php

namespace App\Http\Controllers\ProductControllers;

use App\Http\Controllers\Controller;

use App\Services\ProductService;
use App\Services\Interfaces\ProductServiceInterface;
use App\Http\Resources\ProductResources\ProductResource;
use App\Http\Requests\ProductRequests\StoreProductRequest;

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
     * @return ProductResource
     */
    public function store(StoreProductRequest $request, string $productId = null): ProductResource {
        if ($productId) {
            $product = $this->productService->update($productId, $request->all());
        } else {
            $product = $this->productService->create($request->all());
        }
		
        return new ProductResource($product);
    }
}
