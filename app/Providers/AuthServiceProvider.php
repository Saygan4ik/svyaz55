<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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
        $this->rolePolicies();
        $this->userPolicies();
        //
    }

    public function rolePolicies() {
        Gate::define('edit-roles', function ($user) {
            return $user->hasAccess(['edit-roles']);
        });
    }

    public function userPolicies() {
        Gate::define('edit-users', function ($user) {
            return $user->hasAccess(['edit-users']);
        });
        Gate::define('set-roles', function ($user) {
            return $user->hasAccess(['set-roles']);
        });
    }
}
