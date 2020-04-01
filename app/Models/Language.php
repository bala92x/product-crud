<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Language
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string $slug
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 *
 * @package App\Models
 */
class Language extends Model {
    use SoftDeletes;
	
    protected $table = 'languages';

    protected $fillable = [
		'name',
		'code',
		'slug'
	];
}
