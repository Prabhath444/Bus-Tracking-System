<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PerformanceReport extends Model
{
    protected $fillable = [
        'bus_id',
        'date',
        'avg_speed',
        'stops_missed',
        'alerts_raised',
        'uptime_percent',
    ];

    public function bus(): BelongsTo
    {
        return $this->belongsTo(Bus::class);
    }
}
