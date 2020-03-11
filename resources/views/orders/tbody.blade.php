@forelse($orders as $order )
	<tr>
		<th scope="row">
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
