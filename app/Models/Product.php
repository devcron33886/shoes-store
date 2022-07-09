<?php

namespace App\Models;

use App\Models\Scopes\LiveScope;
use Cknow\Money\Money;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use HasFactory,SoftDeletes,Sluggable,InteractsWithMedia;

   public $with=['variations'];

   public static function booted()
   {
    static::addGlobalScope(new LiveScope());
   }

    protected $fillable = [
        'name', 'slug', 'description', 'price', 'status'

    ];

    public function formattedPrice(): Money
    {
        return Money::RWF($this->price);
    }

    public function variations(): HasMany
    {
        return $this->hasMany(Variation::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
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


    public function categories():BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function scopeTrending($query)
    {
        return $query->inRandomOrder()->take(8);
    }
    public function scopeMight($query)
    {
        return $query->inRandomOrder()->take(4);
    }
}
