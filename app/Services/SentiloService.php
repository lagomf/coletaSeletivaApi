<?php

namespace App\Services;

use Illuminate\Support\Carbon;

class SentiloService
{
    private $sentilo_url, $sentilo_key;

    public function __construct()
    {
        $this->sentilo_url = env("SENTILO_API_URL");
        $this->sentilo_key = env("SENTILO_KEY");
    }
    /**
     * Makes API call to an endpoint at Sentilo.
     *
     * @param string $endpoint - Endpoint to be called.
     * @param string $method - Request method (case insensitive)
     * @param array $body - HTTP body
     * @param array $headers - HTTP extra headers (case insensitive)
     * @param array $params - URL query params
     * @param boolean $http_errors - Decides if HTTP exceptions are thrown
     * @return Illuminate\Http\Client\Response
     * @throws \GuzzleHttp\Exception\ClientException
     */
    private function request($endpoint, $method = 'GET', $body = [], $headers = [], $params = [], $http_errors = true) {
        $exact_headers = [
            'IDENTITY_KEY' => $this->sentilo_key,
            'Accept-Encoding' => 'gzip, deflate, br'
        ];

        $headers = array_merge($exact_headers, $headers ?? []);

        $sentilo_api_url = $this->sentilo_url;
        $url = "$sentilo_api_url/$endpoint";
        return apiCall($url, $method, $body, $headers, $params, $http_errors);
    }

    /**
     * Get observations from a sensor on Sentilo
     * 
     * @param string $provider - Sensor data provider
     * @param string $sensor_identifier - Identifier of the sensor
     */
    public function getObservationsBySensor(string $provider, string $sensor_identifier, $start_date = null, $end_date = null, $limit = 200){
        $params = [
            'limit' => $limit
        ];

        if($start_date){
            if($end_date){
                $params['from'] = $start_date->format("d/m/Y\TH:i:s");
                $params['to'] = $end_date->format("d/m/Y\TH:i:s");
            }else{
                $params['from'] = $start_date->startOfDay()->format("d/m/Y\TH:i:s");
                $params['to'] = $start_date->endOfDay()->format("d/m/Y\TH:i:s");
            }
        }
        
        $endpoint = "data/$provider/$sensor_identifier";
        $response = $this->request($endpoint,'GET',null,null,$params);

        return $response->json();
    }
}