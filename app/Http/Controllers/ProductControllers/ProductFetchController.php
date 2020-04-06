<?php

namespace App\Http\Controllers\ProductControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Interfaces\ProductServiceInterface;
use App\Services\ProductService;
use App\Http\Resources\ProductResources\ProductResource;
use App\Http\Resources\ProductResources\ProductCollection;

class ProductFetchController extends Controller {
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
     * Return a list of products.
     *
     * @return ProductCollection
     */
    public function list(): ProductCollection {
        $products = $this->productService->all();

        return new ProductCollection($products);
    }
	
    /**
     * Return a single product.
     *
	 * @param Request $request
	 * @param string $productId
     * @return ProductResource
     */
    public function get(Request $request, string $productId): ProductResource {
        $product = $this->productService->find($productId);

        return new ProductResource($product);
    }
}
