<li class="car-chooser__item carousel__item {{ $key === 0 ? 'is-active': ''}}" data-slide-index="{{$key}}">
	<figure class="car-chooser__image-wrapper">
		<img src="dist/img/examples/car{{$key}}-small.png"
			srcset="dist/img/examples/car{{$key}}-medium.png 700w, dist/img/examples/car{{$key}}.png 1000w"
			class="car-chooser__image" alt="">
		<figcaption class="car-chooser__type">
			<h3 class="car-chooser__brand">
				{{ $slide->brand }}
			</h3>
			<h2 class="car-chooser__model">
				{{ $slide->model }}
			</h2>
			<p class="car-chooser__pricing">
				Maandkost €400
				{{ $slide->cost }}
			</p>
		</figcaption>
	</figure>
</li>
