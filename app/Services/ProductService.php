<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

use App\Models\Product;
use App\Services\FileService;
use App\Services\InterFaces\ProductServiceInterface;
use App\Services\InterFaces\FileServiceInterface;

class ProductService extends BaseService implements ProductServiceInterface {
    /**
     * The service used to manage files.
	 * 
	 * @var FileService
     */
    private $fileService;
	
    /**
     * Relationships to query.
     * 
     * @var array
     */
    protected $withRelationships = [
		'productTranslations',
		'productTags'
	];

    /**
     * ProductService constructor.
     *
     * @param Product $model
	 * @return void
     */
    public function __construct(Product $model, FileServiceInterface $fileService) {
        parent::__construct($model);
		
        $this->fileService = $fileService;
        $this->bootRelationships();
    }
	
    /**
     * Create a new instance.
     *  
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model {
        $product = $this->model->create($attributes);
		
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

        $product->update($attributes);
		
        if (isset($attributes['product_translations'])) {
            $this->updateOrCreateTranslations($product, $attributes['product_translations']);
        }

        if (isset($attributes['product_tag_ids'])) {
            $product->productTags()->sync($attributes['product_tag_ids']);
        }

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
            $product->productTags()->detach();
            $product->productTranslations()->delete();
			
            return $product->delete();
        }

        return false;
    }
	
    /**
     * Delete the product files folder.
     *
     * @return bool
     */
    public function deleteAllFiles(): bool {
        return $this->fileService->deleteDirectory('public/products');
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