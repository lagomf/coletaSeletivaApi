<?php

namespace App\Policies;

use App\Models\SupportRequest;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class SupportRequestPolicy
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
        return $user->can('view supportRequests')
                ? Response::allow()
                : Response::deny('You are not allowed to view support requests.');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SupportRequest  $SupportRequest
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, SupportRequest $SupportRequest)
    {
        return ($user->is($SupportRequest->requester) || $user->can('view supportRequests'))
            ? Response::allow()
            : Response::deny('You are not allowed to show this support requests.');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create supportRequests')
                ? Response::allow()
                : Response::deny('You are not allowed to create support requests.');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SupportRequest  $SupportRequest
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function respond(User $user, SupportRequest $SupportRequest)
    {
        return $user->can('respond supportRequests')
                ? Response::allow()
                : Response::deny('You are not allowed to respond support requests.');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SupportRequest  $SupportRequest
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, SupportRequest $SupportRequest)
    {
        return $user->can('update supportRequests')
                ? Response::allow()
                : Response::deny('You are not allowed to update support requests.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SupportRequest  $SupportRequest
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, SupportRequest $SupportRequest)
    {
        return ($user->is($SupportRequest->requester) || $user->can('delete supportRequests'))
            ? Response::allow()
            : Response::deny('You are not allowed to delete this support requests.');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SupportRequest  $SupportRequest
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, SupportRequest $SupportRequest)
    {
        return ($user->is($SupportRequest->requester) || $user->can('restore supportRequests'))
            ? Response::allow()
            : Response::deny('You are not allowed to restore this support requests.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SupportRequest  $SupportRequest
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, SupportRequest $SupportRequest)
    {
        return $user->can('hardDelete supportRequests')
                ? Response::allow()
                : Response::deny('You are not allowed to hard delete support requests.');
    }

    /**
     * Determine whether the user can models trashed items.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function withTrashed(User $user)
    {
        return $user->can('withTrashed supportRequests')
                ? Response::allow()
                : Response::deny('You are not allowed to show trashed support requests.');
    }
}
