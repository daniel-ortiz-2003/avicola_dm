<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    protected $table = 'sales';
    protected $fillable = [
        'poutry_lots_id',
        'quantity',
        'price',
        'date',
        'type'
    ];
    public function poultryLots()
    {
        return $this->belongsTo(PoultryLots::class, 'poutry_lots_id');
    }
}
