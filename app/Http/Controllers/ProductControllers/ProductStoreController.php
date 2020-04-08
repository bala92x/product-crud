<?php

namespace App\Http\Controllers\ProductControllers;

use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
     * Store a product request.
     * 
     * @param StoreProductRequest $request
     * @param string $productId
     * @return ProductResource
     */
    public function store(StoreProductRequest $request, $productId = null): ProductResource {
        if (is_null($productId)) {
            return $this->create($request);
        }
		
        return $this->update($request, $productId);
    }
	
    /**
     * Create a product.
     * 
	 * @param StoreProductRequest $request
     * @return ProductResource
	 * 
	 * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function create(StoreProductRequest $request): ProductResource {
        try {
            $product = $this->productService->create($request->all());

            return new ProductResource($product);
        } catch (Exception $e) {
            abort(500, 'Product create error.');
        }
    }
	
    /**
     * Update a product.
     * 
	 * @param StoreProductRequest $request
	 * @param string $productId
     * @return ProductResource
	 * 
	 * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
	 * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function update(StoreProductRequest $request, string $productId): ProductResource {
        try {
            $product = $this->productService->update($productId, $request->all());

            return new ProductResource($product);
        } catch (ModelNotFoundException $e) {
            abort(404, 'This product could not be found.');
        } catch (Exception $e) {
            abort(500, 'Product update error.');
        }
    }
}
