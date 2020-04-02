<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class ProductDeleteController extends Controller {
    /**
     * Delete a product.
     * 
	 * @param string $productId
     * @return JsonResponse
     */
    public function delete(string $productId): JsonResponse {
        // TODO
        return response()->json([
			'method' => 'ProductDeleteController@delete'
		]);
    }
}
