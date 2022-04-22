<?php

namespace App\Http\Controllers;

use App\Exceptions\UserRoleNotAuthorized;
use App\Exceptions\UserRoleNotAuthorizedException;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UpdateUserRoleRequest;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * @param  App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response    
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->validated());

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

        $this->authorize('view', $user);

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
        $user->update($request->validated());
        
        $user->revokeAllTokens();

        return response()->json($user);
    }

    /**
     * Update the specified resource role.
     *
     * @param  App\Http\Requests\UpdateUserRoleRequest;  $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function role(UpdateUserRoleRequest $request, User $user)
    {
        $authorizedRoles = Auth::user()->authorizedRoles()->pluck('name')->toArray();

        $userRole = $user->roles->last() ? $user->roles->last()->name : 'Citizen';

        if(!in_array($request->role,$authorizedRoles) || !in_array($userRole,$authorizedRoles)){
            throw new UserRoleNotAuthorizedException();
        }
        
        $user->syncRoles($request->role);
        
        $user->revokeAllTokens();

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

        $user->revokeAllTokens();

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
