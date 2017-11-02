<html>
<head>
	@include('general/head')
	@include('general/header-scripts')
</head>
<body>
	<div class="page-wrapper">

		<form method="post" action="{{action('CRUDController@update', $id)}}">
			{{csrf_field()}}
			<input name="_method" type="hidden" value="PATCH">
			<div>
				<label>
				 Merk
				</label>
				<div>
					<input type="text" name="brand" value="{{$car->brand}}">
				</div>
			</div>
			<div class="form-group row">
				<label>
					Model
				</label>
				<div class="col-sm-10">
					<input type="text"name="model" value="{{$car->model}}">
				</div>
			</div>
			<div class="form-group row">
				<label>
					Prijs
				</label>
				<div class="col-sm-10">
					 <input type="text" name="cost" value="{{$car->cost}}">
				</div>
			</div>
			<div class="form-group row">
				<button>Aanpassen</button>
			</div>
		</form>
	</div>
	@include('general/scripts')
</body>
</html>
