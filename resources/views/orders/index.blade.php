@extends('layout')

@section('title')
	{{ __('Заказы') }}
@endsection

@section('content')

	<div id="orderTabs">

		<ul class="nav nav-tabs mb-3" id="ordersTab" role="tablist">
			<li class="nav-item">
				<a class="nav-link{{ !$tab || $tab === 'expired' ? ' active' : '' }}" id="expired-tab"
				   data-toggle="tab" href="{{ route('orders.index', [ 'tab' => 'expired' ]) }}"
				   role="tab" aria-controls="expired" aria-selected="{{ !$tab || $tab === 'expired' ? 'true' : 'false' }}">
					{{ __('Просроченные') }}
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link{{ $tab === 'active' ? ' active' : '' }}" id="active-tab"
				   data-toggle="tab" href="{{ route('orders.index', [ 'tab' => 'active' ]) }}"
				   role="tab" aria-controls="active" aria-selected="{{ $tab === 'active' ? 'true' : 'false' }}">
					{{ __('Текущие') }}
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link{{ $tab === 'created' ? ' active' : '' }}" id="created-tab"
				   data-toggle="tab" href="{{ route('orders.index', [ 'tab' => 'created' ]) }}"
				   role="tab" aria-controls="created" aria-selected="{{ $tab === 'created' ? 'true' : 'false' }}">
					{{ __('Новые') }}
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link{{ $tab === 'completed' ? ' active' : '' }}" id="completed-tab"
				   data-toggle="tab" href="{{ route('orders.index', [ 'tab' => 'completed' ]) }}"
				   role="tab" aria-controls="completed" aria-selected="{{ $tab === 'completed' ? 'true' : 'false' }}">
					{{ __('Выполненные') }}
				</a>
			</li>
		</ul>

		<div class="tab-content">

			{{ $orders->appends([ 'tab' => $tab ])->links() }}

			<div class="table-responsive">
				<table class="table table-striped table-hover text-center mb-0">
					<thead class="thead-dark">
						<tr>
							<th scope="col" class="text-right">{{ __('ID заказа') }}</th>
							<th scope="col">{{ __('Партнер') }}</th>
							<th scope="col">{{ __('Стоимость') }}</th>
							<th scope="col">{{ __('Состав заказа') }}</th>
							<th scope="col">{{ __('Статус') }}</th>
						</tr>
					</thead>
					<tbody>
					@forelse($orders as $order )
						<tr>
							<th scope="row" class="text-right">
								<a href="{{ route('orders.edit', [ 'order' => $order->id ]) }}" target="_blank">
									<span>#{{ $order->id }}</span>
								</a>
							</th>
							<td>
								<div>{{ $order->partner->name }}</div>
								<a href="mailto:{{ $order->partner->email }}" class="small">{{ $order->partner->email }}</a>
							</td>
							<td>
								<span class="currency">{{ $order->total }}</span>
							</td>
							<td class="small">
								@foreach($order->products as $product)
									<div class="row">
										<div class="col text-left">
											<a href="{{ route('products.show', [ 'product' => $product->id ]) }}" target="_blank">
												{{ $product->name }}
											</a>
										</div>
										<div class="col-auto">
											<span class="currency">{{ $product->pivot->price }}</span>
											<span>&times;</span>
											<span>{{ $product->pivot->quantity }} {{ __('шт.') }}</span>
										</div>
									</div>
								@endforeach
							</td>
							<td>
								<span class="badge badge-{{ $order->status_label['style'] }}">
									{{ $order->status_label['label'] }}
								</span>
							</td>
						</tr>
					@empty
						<tr>
							<td colspan="5" class="table-info">
								{{ __('Заказы не найдены') }}
							</td>
						</tr>
					@endforelse

					</tbody>
				</table>
				<div class="loading"></div>
			</div>

			{{ $orders->appends([ 'tab' => $tab ])->links() }}

		</div>

	</div>

@endsection
