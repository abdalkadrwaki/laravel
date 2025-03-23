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
     * @var array
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

        // تعريف صلاحيات المستخدمين
        Gate::define('Administrator', function (User $user) {
            return $user->role_id == 1;
        });

        Gate::define('Lessons', function (User $user) {
            return $user->role_id == 2;
        });

        Gate::define('manage-courses', function (User $user) {
            return $user->role_id == 3;
        });

        Gate::define('manage-Lessons', function (User $user) {
            return in_array($user->role_id, [2, 3]);
        });
    }
}
