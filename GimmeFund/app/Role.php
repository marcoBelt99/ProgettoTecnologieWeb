<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * Creo la relazione tra Ruolo e Utente. N:M
     */
    public function users() {
        return $this->belongsToMany('App\User');
    }
}
