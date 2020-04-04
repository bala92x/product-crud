<?php

namespace App\Http\Resources\ProductResources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ProductResource
 * 
 * @package App\Http\Resources\ProductResources
 */
class ProductResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        return [
			'id' 					=> $this->id,
			'published_at' 			=> $this->published_at,
			'published_until' 		=> $this->published_until,
			'price' 				=> $this->price,
			'image_path' 			=> $this->image_path,
			'created_at' 			=> $this->created_at,
			'updated_at' 			=> $this->updated_at,
			'product_translations' 	=> ProductTranslationResource::collection($this->product_translations),
			'product_tags' 			=> ProductTagResource::collection(
				$this->whenLoaded('productTags')
			)
		];
    }
}
