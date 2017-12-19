<html>
<head>
	@include('general/head')
	@include('general/header-scripts')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.6/css/fileinput.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
</head>
<body>
	<div class="page-wrapper">
		@include('general/nav')

		<div class="col-md-8">
			<h2>Alle auto's</h2>
			<table id="car-table" class="table table-striped" style="border: 1px solid #636363">
				<thead>
					<tr>
						<th>Thumbnail</th>
						<th>Merk</th>
						<th>Model</th>
						<th>Type</th>
						<th>Kost</th>
						<th>Bewerk</th>
						<th>Delete</th>
					</tr>
				</thead>
				<tbody>
				@foreach($cars as $car)
					<tr>
						<td>
							<?php $model = str_replace(' ', '-', $car['model']) ?>
							<img src="<?php echo 'dist/img/examples/car-'.$model.'-small.png' ?>"
								 class="img-thumbnail" alt="car"
							>
						</td>
						<td>{{$car['brand']}}</td>
						<td>{{$car['model']}}</td>
						<td>{{$car['type']}}</td>
						<td>{{$car['cost']}}</td>

						<td>
							<a href="{{action('CRUDController@edit', $car['id'])}}">
								<button class="btn btn-warning" type="submit">
									<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
								</button>
							</a>
						</td>
						<td>
							<form action="{{action('CRUDController@destroy', $car['id'])}}" method="post">
								{{csrf_field()}}
								<input name="_method" type="hidden" value="DELETE">
								<button class="btn btn-danger" type="submit">
									<i class="fa fa-trash-o" aria-hidden="true"></i>
								</button>
							</form>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>

		<div class="col-md-4">
			<h1>Voeg toe</h1>
			@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
			<form method="post" action="{{url('cars')}}" class="form" enctype="multipart/form-data">
				{{csrf_field()}}
				<ul class="form__list">
					<li class="form__row">
						<label for="brand"
							   class="form__label">
							Merk
						</label>
						<input type="text"
							   name="brand" id="brand"
							   class="form__input"
							   value="{{ old('brand') }}"
							   placeholder="Volkswagen">
					</li>
					<li class="form__row">
						<label for="model"
							   class="form__label">
							Model
						</label>
						<input type="text"
							   name="model" id="model"
							   class="form__input"
							   value="{{ old('model') }}"
							   placeholder="Golf">
					</li>
					<li class="form__row">
						<label for="type"
							   class="form__label">
							Type
						</label>
						<input type="text"
							   name="type" id="type"
							   class="form__input"
							   value="{{ old('type') }}"
							   placeholder="Berline">
					</li>
					<li class="form__row">
						<label for="cost"
							   class="form__label">
							Prijs
						</label>
						<input type="text"
							   name="cost" id="cost"
							   value="{{ old('cost') }}"
							   class="form__input"
							   placeholder="450">
					</li>
					<li class="form__row">
						<label for="image"
							   class="form__label">
							Foto
						</label>
						(Afmetingen: 950px - 500px)
						<input id="input-b1" name="image" type="file" data-show-upload="false" class="file">

					</li>
					<li class="form__row form__row--footer">
						<button class="form__button">
							Toevoegen
						</button>
					</li>
				</ul>
			</form>
		</div>
	</div>
	@include('general/scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.6/js/fileinput.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
	<script>
        jQuery( document ).ready(function( $ ) {
            $('#car-table').DataTable({
                "iDisplayLength": 5
			});
        } );
	</script>
</body>
</html>
