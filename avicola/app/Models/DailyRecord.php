<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DailyRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'flock_id',
        'record_date',
        'mortality_count',
        'average_weight_gr',
        'feed_consumed_kg',
        'water_consumed_lt',
        'observations',
    ];

    /**
     * Get the flock that owns the daily record.
     */
    public function flock(): BelongsTo
    {
        return $this->belongsTo(Flock::class);
    }
}
