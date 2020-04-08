<?php

namespace App\Http\Resources\ProductResources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductTagResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        return [
			'id' 						=> $this->id,
			'createdAt' 				=> $this->created_at,
			'updatedAt' 				=> $this->updated_at,
			'productTagTranslations' 	=> ProductTagTranslationResource::collection(
				$this->whenLoaded('productTagTranslations')
			)
		];
    }
}
