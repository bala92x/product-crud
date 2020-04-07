<?php

namespace App\Http\Resources\ProductResources;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource {
    /**
     * Customize the outgoing response for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\JsonResponse $response
     * @return void
     */
    public function withResponse($request, $response): void {
        if ($request->getMethod() === 'POST' && is_null($request->productId)) {
            $response->setStatusCode(201);
        }
    }
	
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        $transformedArray = [
			'id' 					=> $this->id,
			'publishedAt' 			=> $this->published_at,
			'publishedUntil' 		=> $this->published_until,
			'price' 				=> $this->price,
			'createdAt' 			=> $this->created_at,
			'updatedAt' 			=> $this->updated_at,
			'productTranslations' 	=> ProductTranslationResource::collection($this->product_translations),
			'productTags' 			=> ProductTagResource::collection(
				$this->whenLoaded('productTags')
			)
		];

        if ($this->image_path === '/images/default-product-image.png') {
            $transformedArray['imagePath'] = url($this->image_path);
        } else {
            $transformedArray['imagePath'] = asset(Storage::url($this->image_path));
        }
		
        return $transformedArray;
    }
}
