/**
 * main.script.js
 *
 * Custom, additional scripts
 */

// Only serve javascript to 'Cutting the Mustard' browsers
if($('html').hasClass('ctm')){

	$(document).ready(function(){

		/* Initiate all available classes */
		appendAround.init('.js-appendAround');    // Init append around
		alerts.init(push_message);                // Init alerts
		smoothScroll.init('.js-scroll');          // Init smooth scrolling
		routing.init();                           // Init routing
		// verticalGrid.init($('.js-verticalGrid'),$(window)); // Vertically distribute elements to the window height

		// Init example of an error in a modal box
		// alerts.addMessage({status: 'error', content: 'OMG! Something terrible must have happened here!', timeout: 0, type: 'box-modal'});

		// Initiate popup event handlers
		$('.js-popup').on('click', {}, popup.openWindow); // Example of how to attach an eventhandler and calling a function

		/* Initiate externalize event handlers (settings: http://j.mp/P3xv1i) */
		$('.js-external').externalize({relation: 'external nofollow', title: 'Opens link in new window'});
		// $('a[href$=".pdf"]').externalize({ title: 'Opens PDF in a new window' });

	});

	$(window).load(function() {

		/* For image based functionality use onload */
		// flexslider.init('#Slider');              // Flexslider

		$.resizeThrottle({                       // Resize throttling and callbacks
			options : {
				throttletime : 100
			},
			callback: function() {
				/* The functions that should be fired on resize */
				appendAround.appendAroundElement('.js-appendAround'); // fire appendAround with element
				// verticalGrid.init($('.js-verticalGrid'),$(window)); // Vertically distribute elements to the window height
			}
		});
	});
}
