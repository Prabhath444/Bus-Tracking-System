<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LatestLocationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'busId' => $this->bus_id,
            'latitude' => (float) $this->latitude,
            'longitude' => (float) $this->longitude,
            'speed' => (float) $this->speed,
            'timestamp' => $this->timestamp,
            'plateNumber' => $this->bus->plate_number,
        ];
    }
}
