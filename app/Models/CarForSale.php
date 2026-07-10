<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarForSale extends Model
{
    protected $table = 'cars_for_sale';

    protected $fillable = [
        'make',
        'model',
        'year',
        'price',
        'mileage',
        'transmission',
        'fuel_type',
        'engine_size',
        'color',
        'description',
        'image',
        'gallery',
        'active',
    ];

    protected $casts = [
        'gallery' => 'array',
        'price' => 'decimal:2',
    ];
}
