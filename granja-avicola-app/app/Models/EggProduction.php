<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EggProduction extends Model
{
    use HasFactory;

    protected $fillable = [
        'flock_id',
        'collection_date',
        'total_eggs',
        'first_quality_eggs',
        'second_quality_eggs',
        'broken_eggs',
    ];

    /**
     * Get the flock that owns the egg production record.
     */
    public function flock(): BelongsTo
    {
        return $this->belongsTo(Flock::class);
    }
}
