<?php

namespace App\Http\Controllers;

use App\Models\SupportRequest;
use App\Http\Requests\StoreSupportRequestRequest;
use App\Http\Requests\UpdateSupportRequestRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class SupportRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Gate::inspect('viewAny', SupportRequest::class);

        if ($response->allowed()) {
            $requests = SupportRequest::withTrashedResource()->withRelationships()->filterSortPaginate();
        } else {
            $requests = SupportRequest::where('requester_id',Auth::user()->id)->withTrashedResource()->withRelationships()->filterSortPaginate();
        }

        return response()->json($requests);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSupportRequestRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSupportRequestRequest $request)
    {
        $supportRequest = SupportRequest::create($request->all());

        return response()->json($supportRequest);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $supportRequest
     * @return \Illuminate\Http\Response
     */
    public function show($supportRequest)
    {
        $supportRequest = SupportRequest::withTrashedResource()->withRelationships()->findOrFail($supportRequest);

        $this->authorize('show', $supportRequest);

        return response()->json($supportRequest);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSupportRequestRequest  $request
     * @param  \App\Models\SupportRequest  $supportRequest
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSupportRequestRequest $request, SupportRequest $supportRequest)
    {
        $supportRequest->update($request->all());

        return response()->json($supportRequest);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SupportRequest  $supportRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(SupportRequest $supportRequest)
    {
        //
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int $supportRequest
     * @return \Illuminate\Http\Response
     */
    public function restore($supportRequest)
    {
        $supportRequest = SupportRequest::onlyTrashed()->findOrFail($supportRequest);
        
        $this->authorize('restore', $supportRequest);

        $supportRequest->restore();

        return response()->json($supportRequest);
    }

    /**
     * Remove the specified resource from storage (hard-deletes).
     *
     * @param  int $supportRequest
     * @return \Illuminate\Http\Response
     */
    public function forceDelete($supportRequest)
    {
        $supportRequest = SupportRequest::onlyTrashed()->findOrFail($supportRequest);

        $this->authorize('hardDelete', $supportRequest);

        $supportRequest->forceDelete();

        return response()->noContent();
    }
}
