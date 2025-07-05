<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoultryLots extends Model
{
    use HasFactory;
    protected $table = 'poultry_lots';
    protected $filltable = [
        'sheds_id',
        'quantity',
        'date_entry'
    ];
    public function sheds()
    {
        return $this->belongsTo(Sheds::class, 'sheds_id');
    }
    public function sales()
    {
        return $this->hasMany(Sales::class);
    }
    public function mortality()
    {
        return $this->hasMany(Mortality::class);
    }
    public function inputs()
    {
        return $this->hasMany(Inputs::class);
    }

}
