<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Vehicle::class);
        
        $vehicles = Vehicle::withTrashedResource()->withRelationships()->filterSortPaginate();

        return response()->json($vehicles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreVehicleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVehicleRequest $request)
    {
        $vehicle = Vehicle::create($request->validated());

        return response()->json($vehicle);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show($vehicle)
    {
        $vehicle = Vehicle::withTrashedResource()->withRelationships()->findOrFail($vehicle);

        $this->authorize('view', $vehicle);

        return response()->json($vehicle);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVehicleRequest  $request
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVehicleRequest $request, Vehicle $vehicle)
    {
        $vehicle->update($request->validated());

        return response()->json($vehicle);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicle $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        $this->authorize('delete', $vehicle);

        $vehicle->delete();

        return response()->noContent();
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int $vehicle
     * @return \Illuminate\Http\Response
     */
    public function restore($vehicle)
    {
        $vehicle = Vehicle::onlyTrashed()->findOrFail($vehicle);
        
        $this->authorize('restore', $vehicle);

        $vehicle->restore();

        return response()->json($vehicle);
    }

    /**
     * Remove the specified resource from storage (hard-deletes).
     *
     * @param  int $vehicle
     * @return \Illuminate\Http\Response
     */
    public function forceDelete($vehicle)
    {
        $vehicle = Vehicle::onlyTrashed()->findOrFail($vehicle);

        $this->authorize('hardDelete', $vehicle);

        $vehicle->forceDelete();

        return response()->noContent();
    }
}
