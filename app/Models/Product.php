<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
 * @property HasMany $product_translations
 * @property BelongsToMany $product_tags
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

    protected $appends = [
		'productTranslations'
	];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted(): void {
        static::deleting(function ($product) {
            // TODO: delete image
            $product->productTags()->detach();
            $product->productTranslations()->delete();
        });
    }

    /**
     * Get the translations of the product.
     *
     * @return HasMany
     */
    public function productTranslations(): HasMany {
        return $this->hasMany(ProductTranslation::class);
    }
	
    /**
     * Get the product translations attribute.
	 * 
	 * @return Collection
     */
    public function getProductTranslationsAttribute(): Collection {
        return $this->productTranslations()->get();
    }

    /**
     * Get the tags of the product.
	 * 
	 * @return BelongsToMany
     */
    public function productTags(): BelongsToMany {
        return $this->belongsToMany(ProductTag::class, ProductProductTag::class, 'product_id');
    }
}
