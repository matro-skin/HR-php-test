<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

	protected $fillable = [
		'name', 'price', 'vendor_id'
	];

	protected $casts = [
		'price' => 'integer',
	];

	protected $perPage = 25;

	public function vendor()
	{
		return $this->belongsTo(Vendor::class);
	}

}
