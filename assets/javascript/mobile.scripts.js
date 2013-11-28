/**
 * mobile.scripts.js
 *
 * Mobile specific scripts
 */

$(document).ready(function(){

	/* Add 'js' class to html element */
	$('html').removeClass('no-js').addClass('js');

	/* Initiate all available classes */
	smoothScroll.init('.js-scroll');          // Init smooth anchor scroll
	alerts.init(push_message);                // Init alerts
	routing.init();                           // Init routing
	// toggleList.init();                        // Init toggle list
	// swipeSlider.init('#slider', true);        // Init swipe (bullets: true)

});
