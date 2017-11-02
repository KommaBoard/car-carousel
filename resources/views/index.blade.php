<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
	@include('general/head')
	@include('general/header-scripts')
</head>
<body>
	<div class="page-wrapper">
		@include('carousel/carousel')
	</div>
	@include('general/scripts')
</body>
</html>
