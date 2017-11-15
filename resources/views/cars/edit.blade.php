<html>
<head>
	@include('general/head')
	@include('general/header-scripts')
</head>
<body>
	<div class="page-wrapper">
		@include('general/nav')

		<div class="col-md-1"></div>
		<div class="col-md-10">
			<form method="post" action="{{action('CRUDController@update', $id)}}" class="form">
				{{csrf_field()}}
				<ul class="form__list">
					<li class="form__row">
						<label>Merk</label>
						<input type="text" name="brand" class="form__input" value="{{$car->brand}}">
					</li>
					<li class="form__row">
						<label>Model</label>
						<input type="text"name="model" class="form__input" value="{{$car->model}}">
					</li>
					<li class="form__row">
						<label>Type</label>
						<input type="text"name="type" class="form__input" value="{{$car->type}}">
					</li>
					<li class="form__row">
						<label>Prijs</label>
						<input type="text" name="cost" class="form__input" value="{{$car->cost}}">
					</li>
					<li class="form__row form__row--footer">
						<button class="form__button">
							Aanpassen
						</button>
					</li>
				</ul>
				<input name="_method" type="hidden" value="PATCH">
			</form>
		</div>
		<div class="col-md-1"></div>
	</div>

	@include('general/scripts')
</body>
</html>
