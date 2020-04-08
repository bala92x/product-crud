<?php

namespace App\Http\Controllers\ProductControllers;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
	 * 
	 * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function list(): ProductCollection {
        try {
            $products = $this->productService->all();
			
            return new ProductCollection($products);
        } catch (Exception $e) {
            abort(500, 'Product fetch error.');
        }
    }
	
    /**
     * Return a single product.
     *
	 * @param Request $request
	 * @param string $productId
     * @return ProductResource
	 * 
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
	 * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function get(Request $request, string $productId): ProductResource {
        try {
            $product = $this->productService->find((int)$productId);
			
            return new ProductResource($product);
        } catch (ModelNotFoundException $e) {
            abort(404, 'This product could not be found.');
        } catch (Exception $e) {
            abort(500, 'Product fetch error.');
        }
    }
}
