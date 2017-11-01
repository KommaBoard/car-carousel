<section class="car-chooser">
	<div class="carousel-container">
		<ul class="car-chooser__list carousel fjs-carousel">
			@each('carousel/includes/slide', $cars, 'slide')
		</ul>
	</div>
	{{-- carousel-navigation --}}
	@include('carousel/includes/carousel-navigation')
	{{-- / carousel-navigation --}}
</section>
