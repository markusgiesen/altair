/**
 * Scroll to anchor
 *
 * Needs jquery.min.js
 */

var smoothScroll = {

	/**
	 * Initiate scroll
	 * @param {scroll_element} a string for the element identifier to pass to the scroll event handler
	 */
	init: function(scroll_element) {

		// Set scroller event handlers
		$(scroll_element).on('click', smoothScroll.onScrollClick);

	},

	/**
	 * What to do at scroll click
	 * @param {element} a string for the element identifier to pass to the plugin
	 */
	onScrollClick: function(element) {
		var el = element.target;

		element.preventDefault();
		element.stopPropagation();

		var target=$(el).attr('href');
		var scrollToPosition=$(target).offset().top - 24;

		$('html:not(:animated),body:not(:animated)').animate({scrollTop:scrollToPosition}, 1000, function() {
			// use code below to add hash to url after click
			// window.location.hash = "" + target;
			$('html,body').animate({ scrollTop: scrollToPosition }, 0); // reset the scroll position
		});

		return false;
	}

};
