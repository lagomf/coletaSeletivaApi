<?php

namespace App\Services;

class SensorDataService
{
    private function renderData($data,$explicit = false){
        $observations = $data['observations'];
        $response = [];

        foreach($observations as $observation){
            $coordinates = explode(" ",$observation['location']);
            if(!$explicit){
                $response[] = [
                    (float)$coordinates[0],(float)$coordinates[1]
                ];
            }else{
                $response[] = [
                    'lat' => $coordinates[0],
                    'long' => $coordinates [1]
                ];
            }
        }
        return $response;
    }

    public function getData(string $provider, string $sensor_identifier, $start_date = null, $end_date = null){
        $sentilo_service = new SentiloService();

        $response = $sentilo_service->getObservationsBySensor($provider,$sensor_identifier,$start_date,$end_date);
        // if(!count($response['observations'] )){
        //     $elastic_search_service = new ElasticSearchService();

        //     $response = $elastic_search_service->getObservationsBySensor($provider,$sensor_identifier,$start_date,$end_date);
        // }

        return $this->renderData($response);
    }

    public function getVehicleData($vehicle, $start_date = null, $end_date = null){
        return $this->getData($vehicle->provider->identifier,$vehicle->sensor_identifier,$start_date,$end_date);
    }

    public function getVehiclesData($vehicles, $start_date = null, $end_date = null){
        $response = [];
        foreach($vehicles as $vehicle){
            $data = $this->getVehicleData($vehicle,$start_date,$end_date);
            if(count($data)){
                $response[] = $data;
            }
        }

        return $response;
    }
}