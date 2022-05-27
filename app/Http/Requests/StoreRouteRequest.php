<?php

namespace App\Http\Requests;

use App\Models\Route;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreRouteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::authorize('create',Route::class);
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
            'color' => ['required', 'regex:/^#[\dA-F]{3,6}$/i'],

            'days' => 'required|array|max:7|min:1',
            'days.*' => 'required|numeric|in:0,1,2,3,4,5,6,7',

            'districts' => 'required|array|min:1',
            'districts.*' => 'required|numeric|exists:districts,id',

            'coordinates' => 'required|array|min:2',
            'coordinates.*' => 'required|array|min:2|max:2',
            'coordinates.*.*' => ['required', 'regex:/^-?\d{1,3}\.\d{1,6}$/i']
            
        ];
    }
}
