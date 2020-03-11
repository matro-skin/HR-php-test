<!doctype html>
<html lang="{{ app()->getLocale() }}" class="h-100">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>HR Test</title>
		<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
		<link href="{{ asset('/css/app.css') }}?t={{ filemtime( public_path('/css/app.css') )  }}" rel="stylesheet">
		<link href="{{ asset('/css/style.css') }}?t={{ filemtime( public_path('/css/style.css') ) }}" rel="stylesheet">
	</head>
	<body class="d-flex flex-column h-100" data-path="/{{ request()->path() }}" data-route="{{ request()->route()->getName() }}">
		@include('layout.header')
		<main role="main" class="flex-shrink-0 py-3 py-md-4">
			<div class="container">
				<h1>@yield('title', __('Home Page'))</h1>
				<div id="content">
					@section('content')
						Main page Content
					@show
				</div>
			</div>
		</main>
		@include('layout.footer')
		<script src="{{ asset('/js/app.js') }}?t={{ filemtime( public_path('/js/app.js') ) }}"></script>
		<script src="{{ asset('/js/script.js') }}?t={{ filemtime( public_path('/js/script.js') ) }}"></script>
	</body>
</html>
