<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Alert extends Model
{
    protected $fillable = [
        'bus_id',
        'type',
        'severity',
        'status',
    ];
    public function bus(): BelongsTo
    {
        return $this->belongsTo(Bus::class);
    }
}
