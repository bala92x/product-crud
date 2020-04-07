<?php

namespace App\Http\Resources\ProductResources;

use Illuminate\Http\Resources\Json\JsonResource;

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
			'publishedAt' 			=> $this->published_at,
			'publishedUntil' 		=> $this->published_until,
			'price' 				=> $this->price,
			'imagePath' 			=> $this->image_path,
			'createdAt' 			=> $this->created_at,
			'updatedAt' 			=> $this->updated_at,
			'productTranslations' 	=> ProductTranslationResource::collection($this->product_translations),
			'productTags' 			=> ProductTagResource::collection(
				$this->whenLoaded('productTags')
			)
		];
    }
}
