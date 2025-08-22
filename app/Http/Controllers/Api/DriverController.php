<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DriverResource;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return DriverResource::collection(Driver::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('manage-drivers');

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|unique:drivers,phone|max:255',
            'email' => 'nullable|email|unique:drivers,email|max:255',
            'assigned_bus_id' => 'nullable|integer|exists:buses,id|unique:drivers,assigned_bus_id',
        ]);

        $driver = Driver::create($validatedData);

        return new DriverResource($driver);
    }

    /**
     * Display the specified resource.
     */
    public function show(Driver $driver)
    {
        return new DriverResource($driver);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Driver $driver)
    {
        $this->authorize('manage-drivers');

        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'phone' => ['sometimes', 'required', 'string', 'max:255', Rule::unique('drivers')->ignore($driver->id)],
            'email' => ['sometimes', 'nullable', 'email', 'max:255', Rule::unique('drivers')->ignore($driver->id)],
            'assigned_bus_id' => ['sometimes', 'nullable', 'integer', 'exists:buses,id', Rule::unique('drivers')->ignore($driver->id)],
        ]);

        $driver->update($validatedData);

        return new DriverResource($driver);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Driver $driver)
    {
        $this->authorize('manage-drivers');

        $driver->delete();

        return response()->noContent();
    }
}
