<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
	@include('general/head')
	@include('general/header-scripts')
</head>
<body>
	@if (Auth::check())
		@include('general/nav')
	@endif

	<div class="page-wrapper carousel">
		@include('carousel/carousel')
	</div>

	<div class="container-fluid">
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<div class="col-md-4">
				<div class="user-info">
					<h3>Ervaring: {{$experience}} jaar</h3>

					<h3>butoloon: € {{$salary}}</h3>
				</div>
			</div>
			<div class="col-md-8">
				<form method="post" action="/update-cars" class="form" id="updateCars">

					<input type="text" hidden name="salary" value="{{$salary}}">
					<input type="text" hidden name="experience" value="{{$experience}}">

					<p>
						<label for="amount">butoloon af te staan €:</label>
						<input type="text"
							   id="amount"
							   name="newSalaryToLose"
							   readonly style="border:0; color:#04bcbe; font-weight:bold;"
						/>
						<br>
						<label for="max">max €:</label>
						<input type="text"
							   id="max"
							   name="maxSalaryToLose"
							   value="{{$maxBudgetToSpend}}"
							   readonly style="border:0; color:#04bcbe; font-weight:bold;"
						/>
					</p>

					<div id="slider-range-min"></div>
					<br>

					{{csrf_field()}}
					<ul class="form__list">
						<li class="form__row">
							<label>Ik ben geïnteresseerd in merk:</label>

							<div class="btn-group" data-toggle="buttons">
								@foreach($brands as $brand)
									<label class="btn btn-kommaboard">
										<input type="radio" name="carbrand" value="{{$brand->brand}}" autocomplete="off">
										{{$brand->brand}}
									</label>
								@endforeach
								<label class="btn btn-kommaboard">
									<input type="radio" name="carbrand" value="all" autocomplete="off">
									Alles
								</label>
							</div>
						</li>
						<li class="form__row">
							<label>Ik ben geïnteresseerd in type:</label>
							<br>
							<div class="btn-group" data-toggle="buttons">
								@foreach($types as $type)
									<label class="btn btn-kommaboard">
										<input type="radio" name="cartype" value="{{$type->type}}" autocomplete="off">
										{{$type->type}}
									</label>
								@endforeach
								<label class="btn btn-kommaboard">
									<input type="radio" name="cartype" value="all" autocomplete="off">
									Alles
								</label>
							</div>
						</li>
						<li class="form__row form__row--footer">
							<button class="form__button">
								Update wagens
							</button>
						</li>
					</ul>
				</form>
			</div>
		</div>
		<div class="col-md-1"></div>
	</div>

	<script>
        jQuery( document ).ready(function( $ ) {
            $( "#slider-range-min" ).slider({
                range: "min",
                value: {{$salaryToSpend}},
                min: 0,
                max: {{$maxBudgetToSpend}},
                slide: function( event, ui ) {
                    $( "#amount" ).val( ui.value );
                }
            });

            $( "#amount" ).val($( "#slider-range-min" ).slider( "value" ) );
        });
	</script>

	@include('general/scripts')
</body>
</html>
