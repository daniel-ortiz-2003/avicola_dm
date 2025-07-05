<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inputs extends Model
{
    use HasFactory;

    protected $table = 'inputs';

    protected $fillable = [
        'poultry_lots_id',
        'name',
        'quantity',
        'unit_price',
        'date_entry',
        'date_expiration',
        'type'
    ];

    public function poultryLots()
    {
       return $this->belongsTo(PoultryLots::class, 'poultry_lots_id');
    }
}
