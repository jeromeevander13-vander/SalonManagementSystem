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
        /**
         * Gate for Admin access
         * This matches middleware('can:acces-admin') in your routes.
         */
        Gate::define('acces-admin', function (User $user) {
            return $user->role === 'admin';
        });

        /**
         * Gate for Client access
         * This matches middleware('can:acces-client') in your routes.
         */
        Gate::define('acces-client', function (User $user) {
            return $user->role === 'client';
        });
    }
}