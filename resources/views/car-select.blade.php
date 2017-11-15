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
			<div class="col-md-6">
				<div class="user-info">
					<h3>Ervaring: {{$experience}} jaar</h3>

					<h3>Bruttoloon: € {{$salary}}</h3>
				</div>
			</div>
			<div class="col-md-6">
				<p>
					<label for="amount">Maximaal bruttoloon af te staan:</label>
					<input type="text" id="amount" readonly style="border:0; color:#04bcbe; font-weight:bold;">
				</p>

				<div id="slider-range-min"></div>
				<br>

				<form method="post" action="/update-cars" class="form" id="updateCars">
					{{csrf_field()}}
					<ul class="form__list">
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
                value: {{$maxBudgetToSpend}},
                min: 0,
                max: {{$maxBudgetToSpend}},
                slide: function( event, ui ) {
                    $( "#amount" ).val( "€ " + ui.value );
                }
            });

            $( "#amount" ).val( "€ " + $( "#slider-range-min" ).slider( "value" ) );
        });
	</script>

	@include('general/scripts')
</body>
</html>
