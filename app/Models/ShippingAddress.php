<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShippingAddress extends Model
{
    use HasFactory,SoftDeletes;

    protected $table='shipping_addresses';

    protected $fillable = [
        'address',
        'city',
        'postcode',
        'mobile',
        'payment_method',
    ];

    public function formattedAddress(): string
    {
        return sprintf('%s,%s,%s,%s',
            $this->address,
            $this->city,
            $this->postcode,
            $this->mobile
        );
    }

    public function user() :BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function parment_method() :BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
