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

		/* Initiate externalize event handlers (settings: http://j.mp/P3xv1i) */
		// $('.js-external').externalize({relation: 'external nofollow', title: 'Opens link in new window'});
		// $('a[href$=".pdf"]').externalize({ title: 'Opens PDF in a new window' });

	}, false);

}
