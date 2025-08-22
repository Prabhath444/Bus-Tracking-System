<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RouteResource extends JsonResource
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
            'routeName' => $this->route_name,
            'startPoint' => $this->start_point,
            'endPoint' => $this->end_point,
            'stops' => $this->stops,
        ];
    }
}
