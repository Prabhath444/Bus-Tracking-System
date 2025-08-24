<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PerformanceReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'reportDate' => $this->date,
            'averageSpeed' => $this->avg_speed,
            'stopsMissed' => $this->stops_missed,
            'alertsRaised' => $this->alerts_raised,
            'uptimePercent' => $this->uptime_percent,
            'bus' => [
                'id' => $this->bus->id,
                'plateNumber' => $this->bus->plate_number,
            ]
        ];
    }
}
