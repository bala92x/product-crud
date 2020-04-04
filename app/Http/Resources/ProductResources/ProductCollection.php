<?php

namespace App\Http\Resources\ProductResources;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class ProductCollection
 * 
 * @package App\Http\Resources\ProductResources
 */
class ProductCollection extends ResourceCollection {
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        return [
			'sum'	=> $this->collection->count(),
			'data' 	=> ProductResource::collection($this->collection)
		];
    }
}
