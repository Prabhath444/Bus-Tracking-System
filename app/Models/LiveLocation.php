<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LiveLocation extends Model
{

    public $timestamps = false; //no timestamps for this model
    protected $fillable = [
        'bus_id',
        'latitude',
        'longitude',
        'speed',
        'timestamp',
    ];

    public function bus(): BelongsTo
    {
        return $this->belongsTo(Bus::class);
    }
}
