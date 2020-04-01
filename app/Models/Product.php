<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Product
 *
 * @property int $id
 * @property Carbon $published_at
 * @property Carbon $published_until
 * @property int $price
 * @property string $image_path
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 *
 * @package App\Models
 */
class Product extends Model {
    use SoftDeletes;
	
    protected $table = 'products';

    protected $fillable = [
		'published_at',
		'published_until',
		'price',
		'image_path'
	];
}
