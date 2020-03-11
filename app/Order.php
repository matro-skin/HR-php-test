<?php

namespace App;

use App\Scopes\OrderScopes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{

	use OrderScopes;

	protected $fillable = [
		'status', 'client_email', 'partner_id', 'delivery_dt',
	];

	protected $dates = [
		'delivery_dt', 'created_at', 'updated_at',
	];

	protected $casts = [
		'status' => 'integer',
	];

	protected $perPage = 50;

	protected $with = [
		'products',
		'partner',
	];

	const STATUS_CREATED   = 0;
	const STATUS_APPROVED  = 10;
	const STATUS_COMPLETED = 20;

	public function partner()
	{
		return $this->belongsTo(Partner::class);
	}

	public function products()
	{
		return $this->belongsToMany(Product::class,'order_products')
		            ->withPivot([ 'quantity', 'price' ])
		            ->withTimestamps();
	}

	public function getTotalAttribute()
	{
		return $this->products()->sum( DB::raw('order_products.quantity*order_products.price'));
	}

	public function getStatusLabelAttribute()
	{
		switch ($this->status) {
			case self::STATUS_APPROVED :
				return [
					'label' => __('Подтвержден'),
					'style' => 'primary',
				];
			case self::STATUS_COMPLETED :
				return [
					'label' => __('Завершен'),
					'style' => 'success',
				];
			default :
				return [
					'label' => __('Новый'),
					'style' => 'secondary',
				];
		}
	}

	public static function statuses()
	{
		return [
			self::STATUS_CREATED => __('Новый'),
			self::STATUS_APPROVED => __('Подтвержден'),
			self::STATUS_COMPLETED => __('Завершен'),
		];
	}

}
