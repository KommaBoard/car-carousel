<html>
<head>
	@include('general/head')
	@include('general/header-scripts')
</head>
<body>
	<div class="page-wrapper">
		{{ Form::open(array('url' => 'foo/bar')) }}
		//
		{{ Form::close() }}

		<p>Test</p>
	</div>
	@include('general/scripts')
</body>
</html>
