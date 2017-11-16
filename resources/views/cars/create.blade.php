<html>
<head>
	@include('general/head')
	@include('general/header-scripts')
</head>
<body>
	<div class="page-wrapper">
		@include('general/nav')

		<div class="col-md-9">
			<h1>Alle auto's</h1>
			<table class="table table-striped">
				<thead>
				<tr>
					<th>Merk</th>
					<th>Model</th>
					<th>Type</th>
					<th>Kost</th>
					<th colspan="2">Acties</th>
				</tr>
				</thead>
				<tbody>
				@foreach($cars as $post)
					<tr>
						<td>{{$post['brand']}}</td>
						<td>{{$post['model']}}</td>
						<td>{{$post['type']}}</td>
						<td>{{$post['cost']}}</td>
						<td>
							<a href="{{action('CRUDController@edit', $post['id'])}}">
								<button class="btn btn-warning" type="submit">
									<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
								</button>
							</a>
						</td>
						<td>
							<form action="{{action('CRUDController@destroy', $post['id'])}}" method="post">
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

		<div class="col-md-3">
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
			<form method="post" action="{{url('cars')}}" class="form">
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
							   placeholder="Berline">
					</li>
					<li class="form__row">
						<label for="cost"
							   class="form__label">
							Prijs
						</label>
						<input type="text"
							   name="cost" id="cost"
							   class="form__input"
							   placeholder="100">
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
</body>
</html>
