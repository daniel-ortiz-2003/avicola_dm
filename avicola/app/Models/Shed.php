<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Shed extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'capacity',
        'is_active',
    ];

    /**
     * Get the flocks for the shed.
     */
    public function flocks(): HasMany
    {
        return $this->hasMany(Flock::class);
    }
}
