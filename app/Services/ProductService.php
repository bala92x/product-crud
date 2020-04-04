<?php

namespace App\Services;

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
}