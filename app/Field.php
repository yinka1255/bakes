<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use Notifiable;
	
	public $timestamps = false;

	
}
