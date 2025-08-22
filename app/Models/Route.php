<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $fillable = [
        'route_name',
        'start_point',
        'end_point',
        'stops',
    ];
    protected $casts = [
        'stops' => 'array',
    ];

    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }

    public function busRouteAssignments(): HasMany
    {
        return $this->hasMany(BusRouteAssignment::class);
    }
}
