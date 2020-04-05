<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

use App\Models\Product;
use App\Services\InterFaces\ProductServiceInterface;

/**
 * Class ProductService
 * 
 * @package App\Services
 */
class ProductService extends BaseService implements ProductServiceInterface {

   /**
    * ProductService constructor.
    *
    * @param Product $model
    */
    public function __construct(Product $model) {
        parent::__construct($model);
    }
	
    /**
     * Get all instances.
     * 
     * @return Collection
     */
    public function all(): Collection {
        return $this->model->with(['productTags'])->get();
    }
	
    /**
     * Find an instance by id.
     * 
     * @param int $id
     * @return Model
     */
    public function find(int $id): ?Model {
        return $this->model->with('productTags')->findOrFail($id);
    }
}