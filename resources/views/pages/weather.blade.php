@extends('layout')

@section('content')

	<div class="row">

		<div class="col-md">

			<div class="card">
				<div class="card-body">
					@foreach( $city->getAttributes() as $key => $value )
						<div class="row align-items-center">
							<div class="col text-secondary">{{ $key }}</div>
							<div class="col">{{ $value }}</div>
						</div>
					@endforeach
				</div>
				<div class="card-footer">
					{{ __('To load weather we bind App\City to route') }}
				</div>
			</div>

		</div>

		<div class="col-md">

			<div class="card">
				<div class="card-body">

					@if( $fact )

					<div class="row align-items-center">
						<div class="col text-secondary">{{ __('Температура') }}</div>
						<div class="col">{{ $fact->temp }} &deg;C</div>
					</div>

					<div class="row align-items-center">
						<div class="col text-secondary">{{ __('Ощущаемая температура') }}</div>
						<div class="col">{{ $fact->feels_like }} &deg;C</div>
					</div>

					<div class="row align-items-center">
						<div class="col text-secondary">{{ __('Погода') }}</div>
						<div class="col">{{ __('weather.condition.' . $fact->condition) }}</div>
					</div>

					<div class="row align-items-center">
						<div class="col text-secondary">{{ __('Скорость ветра') }}</div>
						<div class="col">{{ $fact->wind_speed }} {{ __('м/с') }}</div>
					</div>

					<div class="row align-items-center">
						<div class="col text-secondary">{{ __('Направление ветра') }}</div>
						<div class="col">{{ __('weather.wind_dir.' . $fact->wind_dir) }}</div>
					</div>

					<div class="row align-items-center">
						<div class="col text-secondary">{{ __('Давление') }}</div>
						<div class="col">{{ $fact->pressure_mm }} {{ __('мм рт.ст.') }}</div>
					</div>

					<div class="row align-items-center">
						<div class="col text-secondary">{{ __('Влажность воздуха') }}</div>
						<div class="col">{{ $fact->humidity }}%</div>
					</div>

					<div class="row">
						<div class="col-md-6 offset-md-3">
							<object type="image/svg+xml" data="https://yastatic.net/weather/i/icons/blueye/color/svg/{{ $fact->icon }}.svg"></object>
						</div>
					</div>

					@else

						<div class="alert alert-danger mb-0">
							{{ __('Response failed') }}
						</div>

					@endif

				</div>
				<div class="card-footer">
					{{ __('Here is thr response from Yandex.Weather API') }}
				</div>
			</div>

		</div>

	</div>

@endsection
