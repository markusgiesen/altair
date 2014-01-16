/**
 * mobile.scripts.js
 *
 * Mobile specific scripts
 */

// Only serve javascript to 'Cutting the Mustard' browsers
if($('html').hasClass('ctm')){

	$(document).ready(function(){

		/* Add 'js' class to html element */
		$('html').removeClass('no-js').addClass('js');

		/* Initiate all available classes */
		alerts.init(push_message);                // Init alerts
		navMain.init();                           // Init main navigation
		smoothScroll.init('.js-scroll');          // Init smooth anchor scroll
		// routing.init();                           // Init routing
		// toggleList.init();                        // Init toggle list

	});
}
