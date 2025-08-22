<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
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
            'day' => $this->day,
            'departureTime' => $this->departure_time,
            'arrivalTime' => $this->arrival_time,
            'route' => [
                'id' => $this->route->id,
                'name' => $this->route->route_name,
            ],
            'bus' => [
                'id' => $this->bus->id,
                'plateNumber' => $this->bus->plate_number,
            ],
            'driver' => [
                'id' => $this->driver->id,
                'name' => $this->driver->name,
            ],
        ];
    }
}
