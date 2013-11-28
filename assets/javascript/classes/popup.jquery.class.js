/**
 * Popup window
 *
 * Simple popupwindow
 * Use "$(a.external).on('click', {}, popup.openWindow)" to initiate
 * Between curly braces set custom height and width, or leave empty.
 * Goes a little something like this: {w: 400, h: 800}
 */

var popup = {
	openWindow: function(event){
		var url = $(event.currentTarget).attr('href');

		if(typeof event.data.h === 'undefined'){
			event.data.h = 400;
		}
		if(typeof event.data.w === 'undefined'){
			event.data.w = 650;
		}

		window.open(url, 'kirbypopupwin', 'height='+ event.data.h +',width='+ event.data.w +',resizable=1,toolbar=0,menubar=0,status=0,location=0,scrollbars=1');
		event.preventDefault();
	}
};

