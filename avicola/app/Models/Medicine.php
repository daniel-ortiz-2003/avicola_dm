<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'supplier',
        'stock_units',
        'unit_price',
    ];

    protected $casts = [
        'stock_units' => 'decimal:2',
        'unit_price' => 'decimal:2',
    ];
}
