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
 * @property int $language_slug
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
	
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_tag_translations';

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
		'product_tag_id',
		'language_slug',
		'name',
		'slug'
	];
}
