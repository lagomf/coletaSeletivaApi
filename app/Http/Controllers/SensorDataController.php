<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetSensorDataRequest;
use App\Http\Requests\GetSensorDataRequestByVehicle;
use App\Models\Vehicle;
use App\Services\SensorDataService;
use Carbon\Carbon;

class SensorDataController extends Controller
{
    public function index(GetSensorDataRequest $request){
        $vehicles = Vehicle::all();

        $date = Carbon::parse($request->date);

        $data_service = new SensorDataService();

        $data = $data_service->getVehiclesData($vehicles,$date);

        return response()->json($data);
    }

    public function byVehicle(GetSensorDataRequestByVehicle $request, Vehicle $vehicle){
        $date = Carbon::parse($request->date);
        $data_service = new SensorDataService();

        $data = $data_service->getData($vehicle->provider->identifier,$vehicle->sensor_identifier,$date);

        return response()->json($data);
    }
}
