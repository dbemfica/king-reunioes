<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Room extends Authenticatable
{

    protected $fillable = [
        'name', 'description'
    ];
}
