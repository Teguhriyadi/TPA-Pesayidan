<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AccessProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::define("admin", function($user) {
            if (empty($user->akses)) {
                return redirect()->route("authorization.logout");
            } else {
                return $user->akses == "ADMIN";
            }
        });

        Gate::define("guru", function($user) {
            if (empty($user->akses)) {
                return redirect()->route("authorization.logout");
            } else {
                return $user->akses == "GURU";
            }
        });
    }
}
