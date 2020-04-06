<?php

namespace App\Http\Resources\ProductResources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ProductTagTranslationResource
 * 
 * @package App\Http\Resources\ProductResources
 */
class ProductTagTranslationResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        return [
			'id' 			=> $this->id,
			'languageSlug'	=> $this->language_slug,
			'name'			=> $this->name,
			'slug'			=> $this->slug,
			'createdAt' 	=> $this->created_at,
			'updatedAt' 	=> $this->updated_at
		];
    }
}
