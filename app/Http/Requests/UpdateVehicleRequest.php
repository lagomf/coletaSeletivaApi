<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateVehicleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::authorize('update',$this->vehicle);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => "sometimes|string",
            "plate" => "sometimes|string",
            "status" => "sometimes|boolean",
            "provider_id" => "sometimes|integer|exists:sensor_providers,id",
            "sensor_identifier" => "sometimes|string"
        ];
    }
}
