<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShippingType extends Model
{
    use HasFactory,SoftDeletes;

    protected $table='shipping_types';


    protected $fillable = [
        'title',
        'price',
        'created_at',
        'updated_at',
        'deleted_at',
    ];


}
