<?php

use Illuminate\Support\Facades\Http;

if (!function_exists('isEnvProduction')) {
    /**
     * Returns whether or not current environment is production
     * 
     * @return bool
     */
    function isEnvProduction()
    {
        return !isEnvTesting() && !isEnvStaging() && !isEnvLocal();
    }
}

if (!function_exists('isEnvTesting')) {
    /**
     * Returns whether or not current environment is testing
     * 
     * @return bool
     */
    function isEnvTesting()
    {
        return app()->environment() === 'testing';
    }
}

if (!function_exists('isEnvStaging')) {
    /**
     * Returns whether or not current environment is staging
     * 
     * @return bool
     */
    function isEnvStaging()
    {
        return app()->environment() === 'staging';
    }
}

if (!function_exists('isEnvLocal')) {
    /**
     * Is Env Local
     * 
     * Returns whether or not current environment is local
     * 
     * @return bool
     */
    function isEnvLocal()
    {
        return in_array(app()->environment(), ["local", "dev"]);
    }
}

if (!function_exists('apiCall')) {
    /**
     * Makes API call to an endpoint.
     *
     * @param string $endpoint - Endpoint to be called
     * @param string $method - Request method (case insensitive)
     * @param array $body - HTTP body
     * @param array $headers - HTTP extra headers (case insensitive)
     * @param array $params - URL query params
     * @param boolean $http_errors - Decides if HTTP exceptions are thrown
     * @param string $body_type - Defines type of body
     * @return Illuminate\Http\Client\Response
     * @throws \GuzzleHttp\Exception\ClientException
     */
    function apiCall($endpoint, $method = 'GET', $body = [], $headers = [], $params = [], $http_errors = true, $body_type = 'json', $query_encode = true) {
        $available_body_types = ['json', 'form_params', 'multipart'];
        if (!in_array($body_type, $available_body_types)) {
            $body_types_string = join(', ', $available_body_types);
            throw new Exception("Body type is not in the available body types (try one of: $body_types_string)");
        }
        $content_type_map = [
            'json' => 'application/json',
            'multipart' => 'multipart/form-data',
            'form_params' => 'application/x-www-form-urlencoded'
        ];
        $default_headers = [
            'accept' => 'application/json',
            'content-type' => $content_type_map[$body_type]
        ];

        // Force lowercase headers
        $headers = collect($headers)->mapWithKeys(function ($value, $key) {
            return [strtolower($key) => $value];
        })->toArray();

        // Merge options
        $headers = array_merge($default_headers, $headers);
        
        $method = strtoupper($method);

        $available_methods = ['HEAD', 'GET', 'POST', 'PUT', 'PATCH', 'DELETE'];
        if (!in_array($method, $available_methods)) {
            $methods_string = join(', ', $available_methods);
            throw new Exception("Method is not in the available methods (try one of: $methods_string)");
        }

        $methods_with_body = ['POST', 'PUT', 'PATCH'];
        $has_body = in_array($method, $methods_with_body);

        $guzzle_options = [
            'headers' => $headers,
            'verify' => isEnvProduction(), // Don't require SSL certificate if env is local
        ];

        if ($has_body) {
            $guzzle_options[$body_type] = $body;
        }

        if ($http_errors) {
            $guzzle_options['http_errors'] = true;
        }
        
        $query_string = http_build_query($params);
        
        if ($query_string != "") {
            $query_string = "?$query_string";
        }

        $response = Http::send($method, $endpoint . $query_string, $guzzle_options);

        return $response;
    }
}