<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fundraiser extends Model
{
    protected $fillable = [
        'name', 'description', 'user_id', 'category_id', 'media_url', 'goal', 'starting_date', 'ending_date'
    ];
}
