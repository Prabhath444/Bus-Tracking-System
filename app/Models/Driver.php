<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Driver extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'assigned_bus_id',
    ];
    public function bus(): BelongsTo
    {
        return $this->belongsTo(Bus::class, 'assigned_bus_id');
    }
    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }
}
