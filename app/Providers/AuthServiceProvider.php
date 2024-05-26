<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Esto lo estoy haciendo para que el usuario en el caso de que sea admin pueda realizar distintas cosas.
        Gate::define('isAdmin',function($user){
            return $user->roles->first()->name == 'admin';
        });

        // Esto lo hago para que el usuario user pueda tener acciones diferentes para los otros usuarios
        Gate::define('isUser',function($user){
            return $user->roles->first()->name == 'user';
        });


    }
}
