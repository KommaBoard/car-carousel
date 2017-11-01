'use strict';

var App = {};

App.main = (function() {
	$(window).on('scroll', _scroll);
	$(window).on('resize', debounce(_resize, 100));
	$(window).on('orientationchange', _resize);
	$(window).on('keydown', _keyDown);

	function _init() {
		$.publish('APP/bootstrap');
	}

	function _load() {
		$.publish('APP/load');
	}

	function _scroll() {
		$.publish('APP/scroll');
	}

	function _resize() {
		$.publish('APP/resize');
	}

	function _keyDown(event) {
		$.publish('APP/keydown', event);
	}

	return {
		'init': _init,
		'load': _load
	};
}());

// dom loaded with IE fix:
if (document.attachEvent) {
	// ie8 way..
	document.attachEvent('onreadystatechange', function() {
		if (document.readyState === 'complete') {
			App.main.init();
		}
	});
} else {
	// normal
	$(document).on('DOMContentLoaded', App.main.init);
}

// window onload
$(window).on('load', App.main.load);

App.main.init();
