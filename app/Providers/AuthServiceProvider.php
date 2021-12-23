<?php

namespace App\Providers;

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

        Gate::define('access-creator',function ($user){
            if ($user->role_id >= 2) {
                return true;
            }
            else{
                return false;
            }
        });
        Gate::define('access-admin',function ($user){
           
            if ($user->role_id== 3) {
                return true;
            }
            else{
                return false;
            }
        });
        //
    }
}