/**
 * Navigation class
 * Add simple navigation functionality (open and close) to .js-nav element
 *
 * Usage:
 * nav.init(); // navigation fixed on top of window
 * nav.init('basic'); // navigation relative at top of document
 */

var navMain = {

	/**
	 * Initiate the navigation
	 */
	init: function(type) {
		$('.js-navMainShow').on('click', navMain.open);
		$('.js-navMainHide').on('click', navMain.close);
	},

	setNavHandlers: function() {
		$('.js-navMain').on('click', navMain.handleNavClick);
		$(document).on('keyup', navMain.handleNavClick);
	},

	unsetNavHandlers: function() {
		$('.js-navMain').off('click');
		$(document).off('keyup');
	},

	handleNavClick: function(event) {
		if(($(event.target).hasClass('js-navMain')) || (event.keyCode === 27)) {
			navMain.close();
			return false;
		}
	},

	open: function() {
		$('html').addClass('is-openMainNav');
		navMain.setNavHandlers();
		return false;
	},

	close: function() {
		$('html').removeClass('is-openMainNav');
		navMain.unsetNavHandlers();
		return false;
	}

};
