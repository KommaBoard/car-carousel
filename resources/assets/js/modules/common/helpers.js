'use strict';

App.helpers = (function() {

	function _between(value, a, b) {
		var min = Math.min.apply(Math, [a, b]),
			max = Math.max.apply(Math, [a, b]);

		return value > min && value < max;
	}

	return {
		'between': _between
	};
}());
