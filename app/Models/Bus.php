<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bus extends Model
{
    protected $fillable = [
        'model',
        'plate_number',
        'status',
        'gps_status',
        'last_check',
    ];

    public function driver(): HasOne
    {
        return $this->hasOne(Driver::class, 'assigned_bus_id');
    }
    public function liveLocations(): HasMany
    {
        return $this->hasMany(LiveLocation::class);
    }

    public function alerts(): HasMany
    {
        return $this->hasMany(Alert::class);
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }

    public function performanceReports(): HasMany
    {
        return $this->hasMany(PerformanceReport::class);
    }

    public function busRouteAssignments(): HasMany
    {
        return $this->hasMany(BusRouteAssignment::class);
    }
}
