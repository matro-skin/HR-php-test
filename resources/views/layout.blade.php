<!doctype html>
<html lang="{{ app()->getLocale() }}" class="h-100">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>HR Test</title>
		@include('layout.meta')
	</head>
	<body class="d-flex flex-column h-100" data-path="/{{ request()->path() }}" data-route="{{ request()->route()->getName() }}">
		@include('layout.header')
		<main role="main" class="flex-shrink-0 py-3 py-md-4">
			<div class="container">
				<h1>@yield('title', __('Home Page'))</h1>
				<div id="content">
					@include('layout.flash')
					@section('content')
						Main page Content
					@show
				</div>
			</div>
		</main>
		@include('layout.footer')
	</body>
</html>
