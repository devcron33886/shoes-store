<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Cart extends Model
{
    use HasFactory, SoftDeletes;


    public static function booted()
    {
        static::creating(function ($model) {
            $model->uuid = (string)Str::uuid();
        });
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function variations(): BelongsToMany
    {
        return $this->belongsToMany(Variation::class)
            ->withPivot('quantity')
            ->orderBy('id');
    }
}
