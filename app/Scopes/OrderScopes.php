<?php

namespace App\Scopes;

use App\Order;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

trait OrderScopes {

	// просроченные
	public function scopeExpired(Builder $query)
	{
		return $query->where('status',Order::STATUS_APPROVED ) // статус заказа 10
		             ->where('delivery_dt', '<', now()); // дата доставки раньше текущего момента
	}

	// текущие
	public function scopeActive(Builder $query)
	{
		return $query->where('status', Order::STATUS_APPROVED) // статус заказа 10
		             ->whereBetween('delivery_dt', [ now(), now()->addHours(24) ]); // дата доставки 24 часа с текущего момента
	}

	// новые
	public function scopeCreated(Builder $query)
	{
		return $query->where('status',Order::STATUS_CREATED ) // статус заказа 0
		             ->where('delivery_dt', '>', now()); // дата доставки после текущего момента
	}

	// выполненные
	public function scopeCompleted(Builder $query)
	{
		return $query->where('status',Order::STATUS_COMPLETED ) // статус заказа 20
		             ->whereBetween('delivery_dt', [ Carbon::today(), Carbon::tomorrow() ]); // дата доставки в текущие сутки
	}



}
