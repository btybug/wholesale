<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
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
        /**
         * Determine if the current user can access the admin panel.
         *
         * @param  User $user
         * @return bool
         */
        \Gate::define('moderate-comments', function ($user) {
            // Add your own logic here...
            return (bool) $user->is_admin === true;
        });
    }
}
