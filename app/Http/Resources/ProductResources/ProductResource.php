<?php

namespace App\Http\Resources\ProductResources;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource {
    /**
     * Default image path
     * 
     * @var string
     */
    const DEFAULT_IMAGE_PATH = '/images/default-product-image.png';
	
    /**
     * Customize the outgoing response for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\JsonResponse $response
     * @return void
     */
    public function withResponse($request, $response): void {
        if ($request->getMethod() === 'POST') {
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
			'productTranslations' 	=> ProductTranslationResource::collection(
				$this->whenLoaded('productTranslations')
			),
			'productTags' 			=> ProductTagResource::collection(
				$this->whenLoaded('productTags')
			)
		];

        if (
			$this->image_path === self::DEFAULT_IMAGE_PATH ||
			!Storage::disk('public')->exists($this->image_path)
		) {
            $transformedArray['imagePath'] = url(self::DEFAULT_IMAGE_PATH);
        } else {
            $imagePath 						= trim($this->image_path, '/');
            $transformedArray['imagePath'] 	= asset(Storage::url($imagePath));
        }
		
        return $transformedArray;
    }
}
