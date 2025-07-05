<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mortality extends Model
{
    use HasFactory;
    protected $table = 'mortality';
    protected $fillable = [
        'poultry_lots_id',
        'quantity',
        'date',
        'observation'
    ];
    public function poultryLots()
    {
        return $this->belongsTo(PoultryLots::class, 'poultry_lots_id');
    }

}
