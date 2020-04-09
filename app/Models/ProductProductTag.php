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
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products_product_tags';
	
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
		'created_at'	=> 'string',
		'updated_at'	=> 'string'
	];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'product_id',
		'product_tag_id'
	];
}
