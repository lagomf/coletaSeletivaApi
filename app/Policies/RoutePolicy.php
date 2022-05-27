<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Route;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class RoutePolicy
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
        return $user->can('view routes')
                ? Response::allow()
                : Response::deny('You are not allowed to view routes.');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Route  $route
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Route $route)
    {
        return $user->can('show routes')
                ? Response::allow()
                : Response::deny('You are not allowed to show routes.');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create routes')
                ? Response::allow()
                : Response::deny('You are not allowed to create routes.');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Route  $route
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Route $route)
    {
        return $user->can('update routes')
                ? Response::allow()
                : Response::deny('You are not allowed to update routes.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Route  $route
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Route $route)
    {
        return $user->can('delete routes')
                ? Response::allow()
                : Response::deny('You are not allowed to delete routes.');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Route  $route
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Route $route)
    {
        return $user->can('restore routes')
                ? Response::allow()
                : Response::deny('You are not allowed to restore routes.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Route  $route
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Route $route)
    {
        return $user->can('hardDelete routes')
                ? Response::allow()
                : Response::deny('You are not allowed to hard delete routes.');
    }

    /**
     * Determine whether the user can models trashed items.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function withTrashed(User $user)
    {
        return $user->can('withTrashed routes')
                ? Response::allow()
                : Response::deny('You are not allowed to show trashed routes.');
    }
}
