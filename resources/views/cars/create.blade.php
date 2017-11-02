<html>
<head>
	@include('general/head')
	@include('general/header-scripts')
</head>
<body>
	<div class="page-wrapper">
		<div class="layout">
			<h1>Alle autos</h1>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Model</th>
						<th>Merk</th>
						<th>Kost</th>
						<th colspan="2">Acties</th>
					</tr>
				</thead>
				<tbody>
				@foreach($cars as $post)
					<tr>
						<td>{{$post['model']}}</td>
						<td>{{$post['brand']}}</td>
						<td>{{$post['cost']}}</td>
						<td>
							<a href="{{action('CRUDController@edit', $post['id'])}}">Aanpassen</a>
						</td>
						<td>
							<form action="{{action('CRUDController@destroy', $post['id'])}}" method="post">
								{{csrf_field()}}
								<input name="_method" type="hidden" value="DELETE">
								<button class="btn btn-danger" type="submit">Delete</button>
							</form>
						</td>
					</tr>
				@endforeach
				</tbody>
	 		</table>
			<form method="post" action="{{url('crud')}}"
				class="form">
				{{csrf_field()}}
				<ul class="form__list">
					<li class="form__row">
						<label for="brand"
							class="form__label">
							Merk
						</label>
						<input type="text"
							name="brand" id="brand"
							class="form__input">
					</li>
					<li class="form__row">
						<label for="model"
							class="form__label">
							Model
						</label>
						<input type="text"
							name="model" id="model"
							class="form__input">
					</li>
					<li class="form__row">
						<label for="cost"
							class="form__label">
							Prijs
						</label>
						<input type="text"
							name="cost" id="cost"
							class="form__input">
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