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

	<div class="page-wrapper intro-form">
		<div class="col-md-6">
			<h1>Car calculator</h1>
			<p>
				Hello there ..
			</p>
		</div>
		<div class="col-md-6">
			<form method="post" action="/select-your-car" class="form" id="introForm">
				{{csrf_field()}}
				<ul class="form__list">
					<li class="form__row">
						<label>Jaren ervaring</label>
						<input type="text" name="experience" class="form__input" required>
					</li>
					<li class="form__row">
						<label>Bruttoloon</label>
						<input type="text"name="salary" class="form__input" required>
					</li>
					<li class="form__row form__row--footer">
						<button class="form__button">
							Toon mijn wagens
						</button>
					</li>
				</ul>
			</form>
		</div>
	</div>

	@include('general/scripts')
</body>
</html>
