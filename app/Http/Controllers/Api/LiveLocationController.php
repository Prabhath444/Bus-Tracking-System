<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LatestLocationResource;
use App\Models\Bus;
use App\Models\Alert;
use App\Models\LiveLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class LiveLocationController extends Controller
{
    public function storePing(Request $request)
    {
        Log::info('Received GPS Ping:', $request->all());

        $validatedData = $request->validate([
            'bus_id' => 'required|integer|exists:buses,id',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'speed' => 'sometimes|numeric|min:0',
        ]);

        $validatedData['timestamp'] = now();

        LiveLocation::create($validatedData);

        //  Update bus's status
        $bus = Bus::find($validatedData['bus_id']);
        if ($bus) {
            $bus->update([
                'last_check' => now(),
                'gps_status' => 'Online',
            ]);
        }

        //checking the if speed limit exceeds and creates an alert
        if (isset($validatedData['speed'])) {
            $speedLimit = (float) config('services.speed_limit_kph');
            $currentSpeed = (float) $validatedData['speed'];

            if ($currentSpeed > $speedLimit) {
                Alert::create([
                    'bus_id' => $validatedData['bus_id'],
                    'type' => 'Overspeed',
                    'severity' => 'Medium',
                    'status' => 'Active',
                ]);
            }
        }



        return response()->json(['message' => 'Location ping received successfully.']);
    }

    public function getLatestLocations()
    {

        $latestLocations = LiveLocation::with('bus')
            ->whereIn('id', function ($query) {
                $query->select(DB::raw('MAX(id)'))
                    ->from('live_locations')
                    ->groupBy('bus_id');
            })
            ->get();

        return LatestLocationResource::collection($latestLocations);
    }

    public function getLatestForBus(Bus $bus)
    {
        $latestLocation = LiveLocation::where('bus_id', $bus->id)
            ->latest('timestamp')
            ->first();

        if (! $latestLocation) {
            return response()->json(['message' => 'No location data found for this bus.'], 404);
        }

        return new LatestLocationResource($latestLocation);
    }
}
