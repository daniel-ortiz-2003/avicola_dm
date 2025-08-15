<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'supplier',
        'stock_kg',
        'unit_price',
    ];

    protected $casts = [
        'stock_kg' => 'decimal:2',
        'unit_price' => 'decimal:2',
    ];
}
