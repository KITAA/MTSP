<?php

namespace App\Providers;

use App\Models\Membership;
use App\Policies\MembershipPolicy;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Membership::class => MembershipPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        $this->defineGates();
    }

    public function defineGates()
    {
        Gate::define('admin', function ($user) {
            return $user->usertype === 'admin';
        });
    }
}
