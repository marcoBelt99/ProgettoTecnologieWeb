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
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot() // È chiamato all'avvio dell'applicazione
    {
        $this->registerPolicies();

        // I gate vanno definiti qui!!!!

        // Solo gli utenti admin possono gestire gli altri utenti
        // Usata per definire le routes
        Gate::define('manage-users', function($user) {
            return $user->hasRole('admin');
        });

        // Solo gli utenti admin possono effettuare l'azione edit-users
        // Definisco il gate per la modifica
        Gate::define('edit-users', function($user) {
            return $user->hasRole('admin');
        });

        // Definisco il gate per l'eliminazione 
        // Solo gli utenti admin possono effettuare l'azione destroy-user
        Gate::define('destroy-user', function($user){
            return $user->hasRole('admin');
        });
    }
}
