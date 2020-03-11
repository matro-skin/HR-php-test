<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Vendor extends Model
{

	use Notifiable;

	protected $fillable = [
		'name', 'email',
	];

}
