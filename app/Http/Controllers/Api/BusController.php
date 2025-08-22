<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BusResource;
use Illuminate\Http\Request;
use App\Models\Bus;

class BusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buses = Bus::all();
        return BusResource::collection(Bus::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('manage-buses');

        $validatedData = $request->validate([
            'model' => 'required|string|max:255',
            'plate_number' => 'required|string|unique:buses,plate_number|max:255',
            'status' => 'sometimes|in:Active,Inactive,Maintenance',
            'gps_status' => 'sometimes|in:Online,Offline',
        ]);

        $bus = Bus::create($validatedData);

        return new BusResource($bus);
    }

    /**
     * Display the specified resource.
     */
    public function show(Bus $bus)
    {
        return new BusResource($bus);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bus $bus)
    {
        $this->authorize('manage-buses');
        $validatedData = $request->validate([
            'model' => 'sometimes|required|string|max:255',
            'plate_number' => 'sometimes|required|string|max:255|unique:buses,plate_number,' . $bus->id,
            'status' => 'sometimes|required|in:Active,Inactive,Maintenance',
            'gps_status' => 'sometimes|required|in:Online,Offline',
        ]);

        $bus->update($validatedData);

        return new BusResource($bus);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bus $bus)
    {
        $this->authorize('manage-buses');

        $bus->delete();

        return response()->noContent();
    }
}
