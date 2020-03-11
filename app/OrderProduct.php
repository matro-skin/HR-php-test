<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderProduct extends Pivot
{

	protected $table = 'order_products';

	protected $fillable = [
		'quantity', 'price',
	];

	public $timestamps = true;

	protected $appends = [
		'total',
	];

	public function getTotalAttribute()
	{
		return $this->quantity*$this->price;
	}

}
