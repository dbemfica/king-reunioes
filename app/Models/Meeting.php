<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Meeting extends Authenticatable
{

    protected $fillable = [
        'name', 'description','data_time'
    ];
}
