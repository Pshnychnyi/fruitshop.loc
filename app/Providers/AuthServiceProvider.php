<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('VIEW_ADMIN', function(User $user) {
            return $user->canDo('VIEW_ADMIN');
        });

        Gate::define('CHANGE_PERMISSION', function(User $user) {
            return $user->canDo('CHANGE_PERMISSION');
        });

        Gate::define('CREATE_ITEMS', function(User $user) {
            return $user->canDo('CREATE_ITEMS');
        });

        Gate::define('UPDATE_ITEMS', function(User $user) {
            return $user->canDo('UPDATE_ITEMS');
        });

        Gate::define('DELETE_ITEMS', function(User $user) {
            return $user->canDo('DELETE_ITEMS');
        });
    }
}
