/**
 * main.script.js
 *
 * Custom, additional scripts
 */

// Only serve javascript to 'Cutting the Mustard' browsers
if(cutsthemustard){

	document.addEventListener('DOMContentLoaded', function() {

		/* Initiate all available classes */
		alerts.init(push_message);                // Init alerts
		navMain.init();                           // Init main navigation

		/* Init example of an error in a modal box */
		// alerts.addMessage({status: 'error', content: 'OMG! Something terrible must have happened here!', timeout: 0, type: 'box-modal'});

		/* Initiate popup event handlers*/
		var popuplink = document.querySelector('.js-popup');
		if (popuplink !== null) {
			popuplink.addEventListener('click', popup.openWindow, false);
		}

		/* Echo Lazyloading */
//		Echo.init({
//			offset: '0',
//			throttle: '50'
//		});

	}, false);

}
