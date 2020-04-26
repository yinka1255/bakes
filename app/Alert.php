<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    use Notifiable;
	//public $timestamps = false;
}
