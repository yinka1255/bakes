<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Route;

class User extends Authenticatable
{
    use Notifiable;
	
	public $timestamps = false;
}
