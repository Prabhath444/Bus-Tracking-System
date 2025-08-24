<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\PerformanceReportResource;
use App\Models\PerformanceReport;

class PerformanceReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('view-performance-reports');

        $reports = PerformanceReport::with('bus')->latest('date')->get();

        return PerformanceReportResource::collection($reports);
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
        $this->authorize('view-performance-reports');

        // Eager load the bus relationship
        $performanceReport->load('bus');

        return new PerformanceReportResource($performanceReport);
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
