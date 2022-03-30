<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $perpage = 20;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);
        
        $users = User::withTrashedResource()->withRelationships()->filterSortPaginate();

        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\CreateUserRequest  $request
     * @return \Illuminate\Http\Response    
     */
    public function store(CreateUserRequest $request)
    {
        $user = User::create($request->all());

        $user->assignRole('Citizen');
        
        return response()->json($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $user
     * @return \Illuminate\Http\Response
     */
    public function show($user)
    {
        $user = User::withTrashedResource()->withRelationships()->findOrFail($user);

        $this->authorize('show', $user);

        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\UpdateUserRequest;  $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());

        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage (soft-deletes).
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();

        return response()->noContent();
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int $user
     * @return \Illuminate\Http\Response
     */
    public function restore($user)
    {
        $user = User::onlyTrashed()->findOrFail($user);
        
        $this->authorize('restore', $user);

        $user->restore();

        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage (hard-deletes).
     *
     * @param  int $user
     * @return \Illuminate\Http\Response
     */
    public function forceDelete($user)
    {
        $user = User::onlyTrashed()->findOrFail($user);

        $this->authorize('hardDelete', $user);

        $user->forceDelete();

        return response()->noContent();
    }
}
