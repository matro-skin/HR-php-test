@extends('layout')

@section('title')
	{{ __('Редактирвание заказа') }} #{{ $order->id }}
@endsection

@section('content')

	<form id="orderEdit" action="{{ route('orders.update', [ 'order' => $order->id ]) }}"
		  method="post" class="needs-validation" novalidate>

		<div class="form-group row align-items-center">
			<label for="client_email" class="col-sm-2 col-form-label">{{ __('Email клиента') }}</label>
			<div class="col-sm">
				<input type="email" class="form-control" id="client_email" name="client_email"
					   value="{{ $order->client_email }}" required />
				<div class="invalid-tooltip">{{ __('Укажите Email клиента') }}</div>
			</div>
		</div>

		<div class="form-group row align-items-center">
			<label for="partner_id" class="col-sm-2 col-form-label">{{ __('Партнер') }}</label>
			<div class="col-sm">
				<select class="custom-select" name="partner_id" id="partner_id" required>
					@foreach($partners as $partner)
						<option value="{{ $partner->id }}"{{ $partner->id === $order->partner_id ? ' selected' : '' }}>
							{{ $partner->name }} &lt;{{ $partner->email }}&gt;
						</option>
					@endforeach
				</select>
				<div class="invalid-tooltip">{{ __('Укажите партнера') }}</div>
			</div>
		</div>

		<div class="form-group row">
			<label class="col-sm-2 col-form-label">{{ __('Продукты') }}</label>
			<div class="col-sm">
				<div class="table-responsive">
					<table class="table table-striped table-sm mb-0">
						<thead class="thead-dark">
							<tr>
								<th scope="col" class="text-right">#</th>
								<th scope="col">{{ __('Наименование продукта') }}</th>
								<th scope="col" class="text-center">{{ __('Цена/шт.') }}</th>
								<th scope="col" class="text-center">{{ __('Количество') }}</th>
								<th scope="col" class="text-center">{{ __('Сумма') }}</th>
							</tr>
						</thead>
						<tbody>
							@foreach($order->products as $product)
								<tr>
									<th scope="row" class="text-right">#{{ $product->id }}</th>
									<td>{{ $product->name }}</td>
									<td class="text-center"><span class="currency">{{ $product->pivot->price }}</span></td>
									<td class="text-center">{{ $product->pivot->quantity }}</td>
									<td class="text-center"><span class="currency">{{ $product->pivot->quantity*$product->pivot->price }}</span></td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div class="form-group row align-items-center">
			<label class="col-sm-2 col-form-label">{{ __('Статус') }}</label>
			<div class="col-sm">

				@foreach(\App\Order::statuses() as $status_id => $status_label)
					<div class="custom-control custom-radio custom-control-inline">
						<input class="custom-control-input" type="radio"
							   name="status" id="orderStatus{{ $status_id }}"
							   value="{{ $status_id }}"{{ $status_id === $order->status ? ' checked' : '' }} required />
						<label class="custom-control-label" for="orderStatus{{ $status_id }}">{{ $status_label }}</label>
					</div>
				@endforeach

			</div>
		</div>

		<div class="form-group row align-items-center">
			<label class="col-sm-2 col-form-label">{{ __('Сумма') }}</label>
			<div class="col-sm">
				<span class="currency">{{ $order->total }}</span>
			</div>
		</div>

		<div class="form-group row align-items-center">
			<div class="col-sm offset-sm-2">
				<button type="submit" class="btn btn-success">{{ __('Сохранить') }}</button>
			</div>
		</div>

		@csrf
		@method('PUT')

	</form>

@endsection
