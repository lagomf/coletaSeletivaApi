<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserPolicy
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
        return $user->can('view users')
                ? Response::allow()
                : Response::deny('You are not allowed to view users.');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, User $model)
    {
        return ($user->is($model) || $user->can('show users'))
            ? Response::allow()
            : Response::deny('You are not allowed to show users.');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create users')
                ? Response::allow()
                : Response::deny('You are not allowed to create users.');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, User $model)
    {
        return ((!$user->is($model)) && $user->can('update users'))
                ? Response::allow()
                : Response::deny('You are not allowed to update users.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, User $model)
    {
        return ($user->is($model) || $user->can('delete users'))
                ? Response::allow()
                : Response::deny('You are not allowed to delete users.');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, User $model)
    {
        return ($user->is($model) || $user->can('restore users'))
                ? Response::allow()
                : Response::deny('You are not allowed to restore users.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, User $model)
    {
        return ($user->is($model) || $user->can('hardDelete users'))
                ? Response::allow()
                : Response::deny('You are not allowed to hard delete users.');
    }

    /**
     * Determine whether the user can models trashed items.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function withTrashed(User $user)
    {
        return $user->can('withTrashed users')
                ? Response::allow()
                : Response::deny('You are not allowed to show trashed users.');
    }
}
