<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use Notifiable;
	
	public $timestamps = false;

	
}
