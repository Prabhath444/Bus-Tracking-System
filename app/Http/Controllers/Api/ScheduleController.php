<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ScheduleResource;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = Schedule::with(['route', 'bus', 'driver'])->get();
        return ScheduleResource::collection($schedules);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('manage-schedules');

        $validatedData = $request->validate([
            'route_id' => 'required|integer|exists:routes,id',
            'bus_id' => 'required|integer|exists:buses,id',
            'driver_id' => 'required|integer|exists:drivers,id',
            'departure_time' => 'required|date_format:H:i',
            'arrival_time' => 'required|date_format:H:i|after:departure_time',
            'day' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
        ]);

        $schedule = Schedule::create($validatedData);

        $schedule->load(['route', 'bus', 'driver']);

        return new ScheduleResource($schedule);
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
        $schedule->load(['route', 'bus', 'driver']);
        return new ScheduleResource($schedule);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schedule $schedule)
    {
        $this->authorize('manage-schedules');

        $validatedData = $request->validate([
            'route_id' => 'sometimes|required|integer|exists:routes,id',
            'bus_id' => 'sometimes|required|integer|exists:buses,id',
            'driver_id' => 'sometimes|required|integer|exists:drivers,id',
            'departure_time' => 'sometimes|required|date_format:H:i',
            'arrival_time' => 'sometimes|required|date_format:H:i|after:departure_time',
            'day' => 'sometimes|required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
        ]);

        $schedule->update($validatedData);

        $schedule->load(['route', 'bus', 'driver']);

        return new ScheduleResource($schedule);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        $this->authorize('manage-schedules');

        $schedule->delete();

        return response()->noContent();
    }
}
