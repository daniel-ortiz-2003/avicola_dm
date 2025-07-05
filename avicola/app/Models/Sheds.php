<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sheds extends Model
{
    use HasFactory;
    protected $table = 'sheds';
    protected $fillable = [
        'name',
        'date'
    ];
    public function poultryLots()
    {
        return $this->hasMany(PoultryLots::class);
    }
}
