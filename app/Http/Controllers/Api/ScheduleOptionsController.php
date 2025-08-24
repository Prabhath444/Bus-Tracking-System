<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bus;
use App\Models\Driver;
use App\Models\Route;
use Illuminate\Http\Request;

class ScheduleOptionsController extends Controller
{
    public function index()
    {
        // Fetch only the necessary columns for each resource
        $buses = Bus::where('status', 'Active')->get(['id', 'plate_number']);
        $drivers = Driver::all(['id', 'name']);
        $routes = Route::all(['id', 'route_name']);

        return response()->json([
            'buses' => $buses,
            'drivers' => $drivers,
            'routes' => $routes,
        ]);
    }
}
