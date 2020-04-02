<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProductStoreController extends Controller {
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
