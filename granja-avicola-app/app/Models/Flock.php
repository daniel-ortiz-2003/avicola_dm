<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Flock extends Model
{
    use HasFactory;

    protected $fillable = [
        'shed_id',
        'name',
        'type',
        'entry_date',
        'initial_bird_count',
        'current_bird_count',
        'status',
    ];

    /**
     * Get the shed that owns the flock.
     */
    public function shed(): BelongsTo
    {
        return $this->belongsTo(Shed::class);
    }

    /**
     * Get the daily records for the flock.
     */
    public function dailyRecords(): HasMany
    {
        return $this->hasMany(DailyRecord::class);
    }

    /**
     * Get the egg productions for the flock.
     */
    public function eggProductions(): HasMany
    {
        return $this->hasMany(EggProduction::class);
    }
}
