<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class VehiclePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->can('view vehicles')
                ? Response::allow()
                : Response::deny('You are not allowed to view vehicles.');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Vehicle $vehicle)
    {
        return $user->can('show vehicles')
                ? Response::allow()
                : Response::deny('You are not allowed to show vehicles.');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create vehicles')
                ? Response::allow()
                : Response::deny('You are not allowed to create vehicles.');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Vehicle $vehicle)
    {
        return $user->can('update vehicles')
                ? Response::allow()
                : Response::deny('You are not allowed to update vehicles.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Vehicle $vehicle)
    {
        return $user->can('delete vehicles')
                ? Response::allow()
                : Response::deny('You are not allowed to delete vehicles.');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Vehicle $vehicle)
    {
        return $user->can('restore vehicles')
                ? Response::allow()
                : Response::deny('You are not allowed to restore vehicles.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Vehicle $vehicle)
    {
        return $user->can('hardDelete vehicles')
                ? Response::allow()
                : Response::deny('You are not allowed to hard delete vehicles.');
    }

    /**
     * Determine whether the user can models trashed items.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function withTrashed(User $user)
    {
        return $user->can('withTrashed vehicles')
                ? Response::allow()
                : Response::deny('You are not allowed to show trashed vehicles.');
    }

    /**
     * Determine whether the user can view sensor providers.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewProviders(User $user){
        return $user->can('create vehicles') || $user->can('update vehicles')
                ? Response::allow()
                : Response::deny('You are not allowed to view providers.');
    }
}
