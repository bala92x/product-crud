<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProductFetchController extends Controller {
    /**
     * Return a list of products.
     *
     * @return JsonResponse
     */
    public function list(): JsonResponse {
        // TODO
        return response()->json([
			'method' => 'ProductFetchController@list'
		]);
    }
	
    /**
     * Return a single product.
     *
	 * @param Request $request
	 * @param string $productId
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request, string $productId): JsonResponse {
        // TODO
        return response()->json([
			'method' => 'ProductFetchController@get'
		]);
    }
}
