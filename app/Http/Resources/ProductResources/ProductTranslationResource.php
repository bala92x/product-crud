<?php

namespace App\Http\Resources\ProductResources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ProductTranslationResource
 * 
 * @package App\Http\Resources\ProductResources
 */
class ProductTranslationResource extends JsonResource {
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
			'description'	=> $this->description,
			'createdAt' 	=> $this->created_at,
			'updatedAt' 	=> $this->updated_at
		];
    }
}
