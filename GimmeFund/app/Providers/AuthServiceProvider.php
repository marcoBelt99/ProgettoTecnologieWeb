<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //'App\Model' => 'App\Policies\ModelPolicy',
        Fundraiser::class => FundraiserPolicy::class,
        Comment::class => CommentPolicy::class,
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
        
        /* Creo un Gate per permettere di creare raccolte fondi solo agli utenti ordinari (l'admin non le può fare, non ha senso)  */
        Gate::define('make-fundraiser', function($user) {
            return $user->hasRole('user');
        }); 
        
        /* Creo un  Gate per le donazione, che possono essere fatte solo dagli utenti ordinari */
        Gate::define('make-donation', function($user) {
            return $user->hasRole('user');
        });

        /* Creo un Gate per accedere o meno alla pagina dei coupon: se l'utente ha i punti sufficienti allora può accedere a tale pagina, altrimenti no */
        Gate::define('create-coupon', function($user) {
            return $user->hasPoints() && $user->hasRole('user');
        });

        /* Creo un Gate per accedere o meno alla pagina di gestione delle categorie */
        Gate::define('manage-categories', function($user) {
            return $user->hasRole('admin');
        });

        /* Creo un Gate per accedere o meno alla pagina dei grafici e delle statistiche */
        Gate::define('see-analytics', function($user) {
            return $user->hasRole('admin');
        });

        Gate::define('support-us', function($user) {
            return $user->hasRole('user');
        });
    }
}