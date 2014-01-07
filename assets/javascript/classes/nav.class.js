/**
 * Navigation class
 * Add simple navigation functionality (open and close) to .js-nav element
 *
 * Usage:
 * nav.init(); // navigation fixed on top of window
 * nav.init('basic'); // navigation relative at top of document
 */

var nav = {

	/**
	 * Initiate the navigation
	 */
	init: function(type) {
		if(type === 'basic') {
			nav.initBasicNav();
		}

		$('.js-nav-open').on('click touchend', nav.open);
		$('.js-nav-close').on('click touchend', nav.close);
	},

	setNavHandlers: function() {
		$('.js-nav').on('click', nav.handleNavClick);
		$(document).on('keyup', nav.handleNavClick);
	},

	unsetNavHandlers: function() {
		$('.js-nav').off('click');
		$(document).off('keyup');
	},

	handleNavClick: function(event) {
		if(($(event.target).hasClass('js-nav')) || (event.keyCode === 27)) {
			nav.close();
			return false;
		}
	},

	open: function() {
		$('.js-nav').addClass('js-isOpen');
		nav.setNavHandlers();
		return false;
	},

	close: function() {
		$('.js-nav').removeClass('js-isOpen');
		nav.unsetNavHandlers();
		return false;
	},

	initBasicNav: function() {
		$('.js-nav').addClass('NavWrapper--basic').prependTo('body');
		$('.NavMainToggle').addClass('NavMainToggle--basic');
	}

};
