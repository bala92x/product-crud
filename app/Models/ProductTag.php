<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class ProductTag
 *
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 * @property HasMany $product_tag_translations
 * @property BelongsToMany $products
 *
 * @package App\Models
 */
class ProductTag extends Model {
    use SoftDeletes;
	
    protected $table = 'product_tags';
	
    protected $appends = [
		'product_tag_translations'
	];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted(): void {
        static::deleting(function ($productTag) {
            $productTag->products()->detach();
            $productTag->productTagTranslations()->delete();
        });
    }

    /**
     * Get the translations of the product tag.
     * 
     * @return HasMany
     */
    public function productTagTranslations(): HasMany {
        return $this->hasMany(ProductTagTranslation::class);
    }
	
    /**
     * Get the product tag translations attribute.
	 * 
	 * @return Collection
     */
    public function getProductTagTranslationsAttribute(): Collection {
        return $this->productTagTranslations()->get();
    }

    /**
     * Get the products of the product tag.
	 * 
	 * @return BelongsToMany
     */
    public function products(): BelongsToMany {
        return $this->belongsToMany(Product::class, ProductProductTag::class, 'product_tag_id');
    }
}
