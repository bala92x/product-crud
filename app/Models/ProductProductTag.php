<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductProductTag
 *
 * @property int $id
 * @property int $product_id
 * @property int $product_tag_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class ProductProductTag extends Model {
    protected $table = 'products_product_tags';

    protected $fillable = [
		'product_id',
		'product_tag_id'
	];
}
