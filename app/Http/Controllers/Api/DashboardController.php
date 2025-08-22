<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Alert;
use App\Models\Bus;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function getStats()
    {
        if (Gate::denies('view-dashboard')) {
            abort(403, 'This action is unauthorized.');
        }

        $totalBuses = Bus::count();
        $onlineBuses = Bus::where('gps_status', 'Online')->count();
        $activeAlerts = Alert::where('status', 'Active')->count();
        $totalDrivers = Driver::count();

        return response()->json([
            'data' => [
                'totalBuses' => $totalBuses,
                'onlineBuses' => $onlineBuses,
                'activeAlerts' => $activeAlerts,
                'totalDrivers' => $totalDrivers,
            ]
        ]);
    }
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
