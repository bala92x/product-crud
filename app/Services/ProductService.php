<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

use App\Models\Product;
use App\Services\ImageService;
use App\Services\InterFaces\ProductServiceInterface;
use App\Services\InterFaces\ImageServiceInterface;

class ProductService extends BaseService implements ProductServiceInterface {
    /**
     * The folder to store the images to.
	 * 
	 * @var string
     */
    const IMAGE_FOLDER_NAME = 'product-images';
	
    /**
     * The service used to manage images.
	 * 
	 * @var ImageService
     */
    private $imageService;

    /**
     * ProductService constructor.
     *
     * @param Product $model
	 * @return void
     */
    public function __construct(Product $model, ImageServiceInterface $imageService) {
        parent::__construct($model);
		
        $this->imageService = $imageService;
    }
	
    /**
     * Get all instances.
     * 
     * @return Collection
     */
    public function all(): Collection {
        return $this->model->with(['productTranslations', 'productTags'])->get();
    }
	
    /**
     * Find an instance by id.
     * 
     * @param int $id
     * @return Model
	 * 
	 * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function find(int $id): Model {
        return $this->model->with(['productTranslations', 'productTags'])->findOrFail($id);
    }
	
    /**
     * Create a new instance.
     *  
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model {
        $product 	= $this->model->create($attributes);
        $imagePath 	= $this->imageService->storeAs(
			$attributes['image'],
			$this->getImageFolder($product->id)
		);
		
        $product->update([
			'image_path' => $imagePath
		]);
		
        $this->updateOrCreateTranslations($product, $attributes['product_translations']);
        $product->productTags()->attach($attributes['product_tag_ids']);
		
        return $this->find($product->id);
    }
	
    /**
     * Update an existing instance.
     *  
     * @param int $id
     * @param array $attributes
     * @return Model
	 * 
	 * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function update(int $id, array $attributes): Model {
        $product = isset($attributes['product']) ? $attributes['product'] : $this->model->findOrFail($id);

        if (isset($attributes['image'])) {
            $imagePath = $this->imageService->replaceAs(
    			$attributes['image'],
    			$this->getImageFolder($product->id)
    		);
		
            $attributes['image_path'] = $imagePath;
        }
		
        $product->update($attributes);
        $this->updateOrCreateTranslations($product, $attributes['product_translations']);
        $product->productTags()->sync($attributes['product_tag_ids']);

        return $this->find($product->id);
    }
	
    /**
     * Delete an instance.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool {
        $product = $this->model->find($id);
		
        if ($product) {
            $this->imageService->deleteDirectory($this->getImageFolder($product->id));
            $product->productTags()->detach();
            $product->productTranslations()->delete();
			
            return $product->delete();
        }

        return false;
    }
	
    /**
     * Delete the product images folder.
     *
     * @return bool
     */
    public function deleteAllImages(): bool {
        return $this->imageService->deleteDirectory($this->getImageFolder());
    }
	
    /**
     * Get the full path of the current image folder
     *  
     * @param int $id
     * @return string
     */
    private function getImageFolder(int $id = null): string {
        return implode('/', ['images', self::IMAGE_FOLDER_NAME, $id]);
    }
	
    /**
     * Update or create product translations
     * 
     * @param Product $product
     * @param array $translations
     * @return void
     */
    private function updateOrCreateTranslations(Product $product, array $translations): void {
        foreach ($translations as $key => $translation) {
            $product->productTranslations()->updateOrCreate([
				'language_slug' => $translation['language_slug']
			], $translation);
        }
    }
}