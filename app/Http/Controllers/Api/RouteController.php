<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RouteResource;
use App\Models\Route;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return RouteResource::collection(Route::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('manage-routes');

        $validatedData = $request->validate([
            'route_name' => 'required|string|unique:routes,route_name|max:255',
            'start_point' => 'required|string|max:255',
            'end_point' => 'required|string|max:255',
            'stops' => 'nullable|array',
            'stops.*' => 'string|max:255'
        ]);

        $route = Route::create($validatedData);

        return new RouteResource($route);
    }

    /**
     * Display the specified resource.
     */
    public function show(Route $route)
    {
        return new RouteResource($route);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Route $route)
    {
        $this->authorize('manage-routes');

        $validatedData = $request->validate([
            'route_name' => ['sometimes', 'required', 'string', 'max:255', Rule::unique('routes')->ignore($route->id)],
            'start_point' => 'sometimes|required|string|max:255',
            'end_point' => 'sometimes|required|string|max:255',
            'stops' => 'sometimes|nullable|array',
            'stops.*' => 'string|max:255'
        ]);

        $route->update($validatedData);

        return new RouteResource($route);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Route $route)
    {
        $this->authorize('manage-routes');

        $route->delete();

        return response()->noContent();
    }
}
