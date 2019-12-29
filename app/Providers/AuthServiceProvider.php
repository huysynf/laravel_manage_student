<?php

namespace App\Providers;

use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Permission;

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
        $permissions=Permission::all();
        foreach ($permissions as $permission){
            Gate::define($permission->slug, function ($user) use ($permission){
                return $user->hasAccessPermissionByRoleId($permission->slug,$user->role_id);
            });
        }

    }
}
