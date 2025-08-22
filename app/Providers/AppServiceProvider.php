<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('manage-buses', function (User $user) {
            return in_array($user->role, ['Admin', 'Manager']);
        });

        Gate::define('manage-drivers', function (User $user) {
            return in_array($user->role, ['Admin', 'Manager']);
        });

        Gate::define('manage-routes', function (User $user) {
            return in_array($user->role, ['Admin', 'Manager']);
        });

        Gate::define('manage-schedules', function (User $user) {
            return in_array($user->role, ['Admin', 'Manager']);
        });

        Gate::define('manage-users', function (User $user) {
            return $user->role === 'Admin';
        });

        Gate::define('view-alerts', function (User $user) {
            return in_array($user->role, ['Admin', 'Manager']);
        });
        Gate::define('view-dashboard', function (User $user) {
            return in_array($user->role, ['Admin', 'Manager']);
        });
    }
}
