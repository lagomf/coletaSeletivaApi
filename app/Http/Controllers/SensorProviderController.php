<?php

namespace App\Http\Controllers;

use App\Models\SensorProvider;
use Illuminate\Http\Request;

class SensorProviderController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $this->authorize('view', SensorProvider::class);

        $providers = SensorProvider::all();

        return response()->json($providers);
    }
}
