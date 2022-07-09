<?php

namespace App\Models;

use Cknow\Money\Money;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class Variation extends Model implements HasMedia
{
    use HasFactory,SoftDeletes,HasRecursiveRelationships,InteractsWithMedia;


    protected $fillable = [
        'product_id',
        'name',
        'price',
        'type',
        'sku',
        'parent_id',
        'order',

    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function inStock(): bool
    {
        return $this->stockCount() > 0;
    }

    public function outOfStock(): bool
    {
        return !$this->inStock();
    }
    public function lowStock(): bool
    {
        return !$this->outOfStock() && $this->stockCount()<=5;
    }

    public function stockCount()
    {
        return $this->descendantsAndSelf->sum(fn($variation) => $variation->stocks->sum('amount'));
    }

    public function stocks(): HasMany
    {
        return $this->hasMany(Stock::class);
    }

    public function formattedPrice(): Money
    {
        return Money::RWF($this->price);
    }

    /**
     * @throws InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb250X250')
            ->fit(Manipulations::FIT_CROP, 250, 250);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('default')
            ->useFallbackUrl(url('/storage/no-product-image-available.png'));
    }

}
