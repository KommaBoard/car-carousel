'use strict';

(function carousel() {
	var transformProp = 'transform',
		carcarouselInstance,
		activeSlide = 0,
		currentSliderItemsIndeces = [],
		CarCarousel;

	$.subscribe('APP/bootstrap', _init);
	$.subscribe('APP/keydown', _keyDown);

	CarCarousel = function(el) {
		this.element = el;

		this.rotation = 0;
		this.panelCount = 0;
		this.totalPanelCount = this.element.children.length;
		this.theta = 0;
	};

	CarCarousel.prototype.modify = function() {
		var panel,
			angle,
			i = 0;

		this.panelSize = this.element.offsetWidth;
		this.rotateFunction = 'rotateY';
		this.theta = 360 / this.panelCount;

		// Math
		this.radius = Math.round(this.panelSize / 2 / Math.tan(Math.PI / this.panelCount));

		for (i; i < this.panelCount; i++) {
			currentSliderItemsIndeces.push(i);

			panel = this.element.children[i];
			angle = this.theta * i;

			panel.style.opacity = 1;

			// let's limit this bad boy up
			this.radius = App.helpers.between(this.radius, 0, 1000) ? this.radius : 0;

			panel.style[transformProp] = 'rotateY(' + angle + 'deg) translateZ(' + this.radius + 'px)';

		}

		// hide the other panels
		for (; i < this.totalPanelCount; i++) {
			panel = this.element.children[i];
			panel.style.opacity = 0;
			panel.style[transformProp] = 'none';
		}

		// adjust rotation so panels are always flat
		this.rotation = Math.round(this.rotation / this.theta) * this.theta;

		this.transform();
	};

	CarCarousel.prototype.transform = function() {
		// push the carousel back in 3D space and rotate it
		this.element.style[transformProp] = 'translateZ(-' + this.radius + 'px) rotateY(' + this.rotation + 'deg)';
	};

	function _spinCarousel(increment) {
		var currentIndex = _getIndex(increment),
			loopIndex = 0;

		carcarouselInstance.rotation += carcarouselInstance.theta * increment * -1;
		carcarouselInstance.transform();

		for (loopIndex; loopIndex < carcarouselInstance.element.children.length; loopIndex++) {
			if (loopIndex === currentIndex) {
				carcarouselInstance.element.children[loopIndex].classList.add('js-active');
			} else {
				carcarouselInstance.element.children[loopIndex].classList.remove('is-active', 'js-active');
			}
		}
	}

	function _init() {
		var carouselEl = document.querySelector('.fjs-carousel'),
			panelCount = carouselEl.children.length,
			navButtons = document.querySelectorAll('.fjs-nav-button'),
			touchArea,
			i = 0,
			touchOpts = {
				'threshold': 15,
				'velocity': 0.2
			},
			_onNavButtonClick,
			_onCarouselSwipe;

		carcarouselInstance = new CarCarousel(carouselEl);
		touchArea = new Hammer(carouselEl, touchOpts);

		_onNavButtonClick = function(event) {
			var increment = parseInt(event.currentTarget.getAttribute('data-increment'), 10);

			event.preventDefault();

			if (increment) {
				_spinCarousel(increment);
			}
		};

		_onCarouselSwipe = function(event) {
			var increment;

			if (event.direction === 2) {
				increment = 1;
			} else if (event.direction === 4) {
				increment = -1;
			}

			if (increment) {
				_spinCarousel(increment);
			}
		};

		for (i; i < navButtons.length; i++) {
			navButtons[i].addEventListener('click', _onNavButtonClick, false);
		}

		touchArea.on('swipeleft swiperight', _onCarouselSwipe);

		// populate on startup
		carcarouselInstance.panelCount = panelCount;
		carcarouselInstance.modify();

		window.setTimeout(function() {
			document.body.className += ' js-carousel-ready';
		}, 0);

		$.subscribe('APP/resize', _resize);

		function _resize() {
			carcarouselInstance.modify();
		}
	}

	function _keyDown(event) {
		var keyCode = event.which;

		switch (keyCode) {
			case 37:
				// left
				_spinCarousel(-1);
				break;
			case 39:
				// right
				_spinCarousel(1);
				break;
			default:
				_spinCarousel(0);
				break;

		}
	}

	function _getIndex(increment) {
		var amountOfSlides = currentSliderItemsIndeces.length - 1;

		activeSlide += increment;

		if (activeSlide < 0) {
			activeSlide = amountOfSlides;
		} else if (activeSlide > amountOfSlides) {
			activeSlide = 0;
		}

		return activeSlide;
	}
}());
