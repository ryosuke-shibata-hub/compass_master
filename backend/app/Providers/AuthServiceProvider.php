<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\Task\Task' => 'App\Policies\TaskPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin',function($user) {
            return ($user->admin_role === 15);
        });

        Gate::define('user',function($user) {
            return in_array($user->admin_role,[7,5,10,15],true);
        });

        //
    }
}