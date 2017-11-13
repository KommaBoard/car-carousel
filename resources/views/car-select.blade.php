<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
	@include('general/head')
	@include('general/header-scripts')
</head>
<body>
	@if (Auth::check())
		Hello there {{ Auth::user()->name }}
		<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
			Logout
		</a>
		<form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
			{{csrf_field()}}
		</form>
	@endif

	<div class="page-wrapper carousel">
		@include('carousel/carousel')
	</div>


	@include('general/scripts')
</body>
</html>
