<?php

namespace App\Providers;

use App\Models\Route;
use App\Models\SupportRequest;
use App\Models\User;
use App\Models\Vehicle;
use App\Policies\RoutePolicy;
use App\Policies\SupportRequestPolicy;
use App\Policies\UserPolicy;
use App\Policies\VehiclePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;
use Illuminate\Auth\Notifications\ResetPassword;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class,
        SupportRequest::class => SupportRequestPolicy::class,
        Vehicle::class => VehiclePolicy::class,
        Route::class => RoutePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();
        
        ResetPassword::createUrlUsing(function ($user, string $token) {
            return env('FRONT_END_URL').'/reset-password?token='.$token;
        });

        // Implicitly grant "Super Admin" role all permissions
        // This works in the app by using gate-related functions like auth()->user->can() and @can()
        Gate::before(function ($user, $ability) {
            return $user->hasRole('Super Admin') ? true : null;
        });
    }
}
