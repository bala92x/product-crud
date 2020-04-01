<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProductTagTranslation
 *
 * @property int $id
 * @property int $product_tag_id
 * @property int $language_id
 * @property string $name
 * @property string $slug
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 *
 * @package App\Models
 */
class ProductTagTranslation extends Model {
    use SoftDeletes;
	
    protected $table = 'product_tag_translations';

    protected $fillable = [
		'product_tag_id',
		'language_id',
		'name',
		'slug'
	];
}
