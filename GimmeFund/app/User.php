<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'birthday', 'points', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    /* Faccio il corrispettivo di quanto fatto in "Role.php" per la funzione "public function users()"  */
    public function roles() 
    {
        return $this->belongsToMany('App\Role');
    }

    /**
     * Ritorno true se l'utente ha un qualche ruolo tra quelli specificati
    */
    public function hasAnyRoles($roles) {
        if ($this->roles()->whereIn(['name', $roles])->first()) {
            return true;
        }

        return false;
    }

    /** 
     * Ritorno true se l'utente ha un ruolo specificato 
     */
    public function hasRole($role) {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }

        return false;
    }

}
