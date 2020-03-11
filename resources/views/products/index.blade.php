@extends('layout')

@section('title')
{{ __('Продукты') }}
@endsection

@section('content')

	<div id="productTabs">

		{{ $products->links() }}

		<div class="table-responsive">
			<table class="table table-striped table-hover text-center">
				<thead class="thead-dark">
					<tr>
						<th scope="col" class="text-right">{{ __('ID продукта') }}</th>
						<th scope="col" class="text-left">{{ __('Наименование') }}</th>
						<th scope="col">{{ __('Поставщик') }}</th>
						<th scope="col" class="text-right">
							<span class="currency">{{ __('Стоимость') }}, </span>
						</th>
					</tr>
				</thead>
				<tbody>

					@forelse($products as $product )
						<tr>
							<th scope="row" class="text-right">
								<span>#{{ $product->id }}</span>
							</th>
							<td class="text-left">{{ $product->name }}</td>
							<td>
								<div>{{ $product->vendor->name }}</div>
								<a href="mailto:{{ $product->vendor->email }}" class="small">{{ $product->vendor->email }}</a>
							</td>
							<td class="text-right">
								<form class="form-inline d-block needs-validation productPrice" method="post"
									  action="{{ route('products.update', [ 'product' => $product->id ]) }}" novalidate>
									<input type="number" name="price" class="form-control text-center"
										   value="{{ $product->price }}" --min="1" --step="1"
										   --required style="width:6rem;" />
									<button type="submit" class="btn btn-primary">
										<i class="las la-pen"></i>
									</button>
									@method('PUT')
									@csrf
								</form>
							</td>
						</tr>
					@empty
						<tr>
							<td colspan="4" class="table-info">
								{{ __('Продукты не найдены') }}
							</td>
						</tr>
					@endforelse

				</tbody>
			</table>
		</div>

		{{ $products->links() }}

	</div>

@endsection
