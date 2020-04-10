<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Services\ProductService;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFormRequest;
use App\Services\Interfaces\ProductServiceInterface;
use App\Http\Resources\ProductResources\ProductResource;
use App\Http\Resources\ProductResources\ProductCollection;


class ProductController extends Controller {
    /**
     * The service used to manage products.
     * 
     * @var ProductService 
     */
    private $productService;
    
    /**
     * Create a new controller instance.
     *
	 * @param ProductService $productService
     * @return void
     */
    public function __construct(ProductServiceInterface $productService) {
        $this->productService = $productService;
    }
	
    /**
     * Display a listing of the resource.
     *
	 * @param Request $request
	 * @return ProductCollection
	 * 
	 * @uses $_GET['page']
	 * @uses $_GET['limit']
	 * 
	 * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function index(Request $request): ProductCollection {
        try {
            $products = $this->productService
							->paginated(
								$request->query('page'),
								$request->query('limit')
							);
			
            return new ProductCollection($products);
        } catch (Exception $e) {
            abort(500, 'Product fetch error.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
	 * @param ProductFormRequest $request
     * @return ProductResource
	 * 
	 * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function store(ProductFormRequest $request): ProductResource {
        try {
            $product = $this->productService->create($request->all());

            return new ProductResource($product);
        } catch (Exception $e) {
            abort(500, 'Product create error.');
        }
    }

    /**
     * Display the specified resource.
     *
	 * @param string $productId
     * @return ProductResource
	 * 
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
	 * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function show(string $productId): ProductResource {
        try {
            $product = $this->productService->find((int)$productId);
			
            return new ProductResource($product);
        } catch (ModelNotFoundException $e) {
            abort(404, 'This product could not be found.');
        } catch (Exception $e) {
            abort(500, 'Product fetch error.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
	 * @param ProductFormRequest $request
	 * @param string $productId
     * @return ProductResource
	 * 
	 * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
	 * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function update(ProductFormRequest $request, string $productId): ProductResource {
        try {
            $product = $this->productService->update((int)$productId, $request->all());

            return new ProductResource($product);
        } catch (ModelNotFoundException $e) {
            abort(404, 'This product could not be found.');
        } catch (Exception $e) {
            abort(500, 'Product update error.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
	 * @param string $productId
     * @return Response
	 * 
	 * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function destroy(string $productId): Response {
        try {
            $this->productService->delete((int)$productId);
			
            return response(null, 204);
        } catch (Exception $e) {
            abort(500, 'Product delete error.');
        }
    }
}
