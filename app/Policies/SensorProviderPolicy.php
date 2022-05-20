<?php

namespace App\Policies;

use App\Models\SensorProvider;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class SensorProviderPolicy
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
        return $user->can('create vehicles') || $user->can('update vehicles')
                ? Response::allow()
                : Response::deny('You are not allowed to view providers.');
    }
}
