<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProductTranslation
 *
 * @property int $id
 * @property int $product_id
 * @property int $language_id
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 *
 * @package App\Models
 */
class ProductTranslation extends Model {
    use SoftDeletes;
	
    protected $table = 'product_translations';

    protected $fillable = [
		'product_id',
		'language_id',
		'name',
		'slug',
		'description'
	];
}
