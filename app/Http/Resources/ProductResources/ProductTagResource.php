<?php

namespace App\Http\Resources\ProductResources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ProductTagResource
 * 
 * @package App\Http\Resources\ProductResources
 */
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
			'created_at' 				=> $this->created_at,
			'updated_at' 				=> $this->updated_at,
			'product_tag_translations' 	=> ProductTagTranslationResource::collection($this->product_tag_translations)
		];
    }
}
