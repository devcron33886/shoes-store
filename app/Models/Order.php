<?php

namespace App\Models;

use App\Models\Presenters\OrderPresenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = [

        'placed_at',
        'packaged_at',
        'shipped_at'
    ];

    protected $dates = [
        'placed_at',
        'packaged_at',
        'shipped_at'
    ];
    protected $fillable = [
        'email',
        'subtotal',
        'placed_at',
        'packaged_at',
        'shipped_at',
    ];

    protected $casts = [
        'placed_at' => 'datetime',
        'packaged_at' => 'datetime',
        'shipped_at' => 'datetime'
    ];

    public array $statuses = [
        'placed_at',
        'packaged_at',
        'shipped_at'
    ];


    public static function booted()
    {
        static::creating(function (Order $order) {
            $order->placed_at = now();

            $order->uuid = (string)Str::uuid();
        });
    }

    public function status()
    {
        return collect($this->statuses)
            ->last(fn($status) => filled($this->{$status}));

    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function shippingType(): BelongsTo
    {
        return $this->belongsTo(ShippingType::class);
    }

    public function shippingAddress(): BelongsTo
    {
        return $this->belongsTo(ShippingAddress::class);
    }
    public function paymentMethod():BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function variations(): BelongsToMany
    {
        return $this->belongsToMany(Variation::class)
            ->withPivot(['quantity'])
            ->withTimestamps();
    }

    public function presenter(): OrderPresenter
    {
        return new OrderPresenter($this);
    }
}
