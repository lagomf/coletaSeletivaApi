<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRouteRequest;
use App\Http\Requests\UpdateRouteRequest;
use App\Models\Route;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$this->authorize('viewAny', Route::class);
        
        $routes = Route::withTrashedResource()->withRelationships()->filterSortPaginate();

        return response()->json($routes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRouteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRouteRequest $request)
    {
        $route = Route::create($request->validated());

        $route->setDays($request->days);
        $route->setDistricts($request->districts);
        $route->setCoordinates($request->coordinates);

        $route->load(['days','districts','coordinates']);

        return response()->json($route);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $route
     * @return \Illuminate\Http\Response
     */
    public function show($route)
    {
        $route = Route::withTrashedResource()->withRelationships()->findOrFail($route);

        $this->authorize('view', $route);

        return response()->json($route);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRouteRequest  $request
     * @param  \App\Models\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRouteRequest $request, Route $route)
    {
        $route->update($request->validated());
        
        if($request->has('days')){
            $route->setDays($request->days);
        }
        if($request->has('districts')){
            $route->setDistricts($request->districts);
        }
        if($request->has('coordinates')){
            $route->setCoordinates($request->coordinates);
        }
        
        $route->load(['days','districts','coordinates']);

        return response()->json($route);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Route $route
     * @return \Illuminate\Http\Response
     */
    public function destroy(Route $route)
    {
        $this->authorize('delete', $route);

        $route->delete();

        return response()->noContent();
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int $route
     * @return \Illuminate\Http\Response
     */
    public function restore($route)
    {
        $route = Route::onlyTrashed()->findOrFail($route);
        
        $this->authorize('restore', $route);

        $route->restore();

        $route->load(['days','districts','coordinates']);

        return response()->json($route);
    }

    /**
     * Remove the specified resource from storage (hard-deletes).
     *
     * @param  int $route
     * @return \Illuminate\Http\Response
     */
    public function forceDelete($route)
    {
        $route = Route::onlyTrashed()->findOrFail($route);

        $this->authorize('hardDelete', $route);

        $route->days()->delete();
        $route->districts()->delete();
        $route->coordinates()->delete();

        $route->forceDelete();

        return response()->noContent();
    }
}
