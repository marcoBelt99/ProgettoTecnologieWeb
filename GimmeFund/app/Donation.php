<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'user_id', 'fundraiser_id', 'amount', 'date', 'anonimate'
    ];
}
