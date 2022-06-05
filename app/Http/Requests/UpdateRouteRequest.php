<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateRouteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::authorize('update',$this->route);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'sometimes|nullable|string',
            'color' => ['sometimes', 'regex:/^#[\dA-F]{3,6}$/i'],

            'days' => 'sometimes|array|max:7|min:1',
            'days.*' => 'required_with:days|numeric|in:0,1,2,3,4,5,6,7',

            'districts' => 'sometimes|array|min:1',
            'districts.*' => 'required_with:districts|numeric|exists:districts,id',

            'coordinates' => 'sometimes|array|min:2',
            'coordinates.*' => 'required_with:coordinates|array|min:2|max:2',
            'coordinates.*.*' => ['required_with:coordinates', 'regex:/^-?\d{1,3}\.\d{1,6}$/i']
            
        ];
    }
}
