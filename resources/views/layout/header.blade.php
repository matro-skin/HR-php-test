<div class="bg-dark">
	<div class="container">
		<nav class="navbar navbar-expand-md navbar-dark px-0">
			<a class="navbar-brand" href="{{ route('index.home') }}">Home</a>
			<button class="navbar-toggler" type="button"
					data-toggle="collapse" data-target="#navbarCollapse"
					aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarCollapse">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link" href="{{ route('weather.city', [ 'city' => 1 ]) }}">{{ __('Погода в Брянске') }}</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="{{ route('orders.index') }}">{{ __('Заказы') }}</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="{{ route('products.index') }}">{{ __('Продукты') }}</a>
					</li>
				</ul>
			</div>
		</nav>
	</div>
</div>
