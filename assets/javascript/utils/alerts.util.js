/**
* messages
*
* Needs jquery.min.js or zepto.min.js
* Launches a messages fixed in the top of the window.
* ----
* To add a message from the html template, paste this code into the template:
*
* <script>
    push_message.push({status: 'info', text: 'This notification is sent from the template', timeout : 3000});
* </script>
*
* Then, pass the array to alerts.init inside main.scripts.js (or maybe mobile.scripts.js) like this:
*
* alerts.init(push_message);
*/

var alerts = {

	/**
	 * Define some basic variable settings for the 'dismiss' button label (and hidden close/cross text)
	 */
	settings: {
		dismiss : 'Dismiss'
	},
	/**
	 * Define the basic options the init of the messages
	 */
	options: {
		type: 'bar'
	},

	/**
	* Initiate the messages function
	*/
	init: function(push_message) {
		// are there language variables set?
		if (typeof LANG_MESSAGE_DISMISS !== 'undefined'){
			this.settings.dismiss = LANG_MESSAGE_DISMISS;
		}

		// are there generated messages from the page?
		if (typeof push_message !== 'undefined'){
			// loop trough the messages array
			for(var i=0; i<push_message.length; i++){
				// show these messages
				alerts.addMessage({status: push_message[i].status, content: push_message[i].text, timeout: push_message[i].timeout, type: push_message[i].type});
			}
		}

		// Close messages when cliked on .bar__dismiss
		$('body').on('click', '.js-dismiss', this.hideNotification );

	},

	/**
	* Method for adding message to DOM body
	* @param {user_options} object with settings for the messages
	* @object user_options {status} a string with the status for the messages (error, info, succes, warning)
	* @object user_options {content} a string with the content of the messages
	* @object user_options {timeout} a string with timeout time for the messages (Can be empty)
	* @object user_options {type} a string to determine what type of box/bar we want (bar, modal) (Can be empty)
	*/
	addMessage: function(options) {

		var message_element;

		$.extend(alerts.options, options);

		if(alerts.options.type === 'bar'){
			message_element = $('<div class="Alert Alert--bar Alert--' + alerts.options.status + ' js-alertAnim" data-element-type="bar"><div class="Alert-message">' + alerts.options.content + '</div><button type="button" class="Alert-close" data-dismiss="Alert" aria-hidden="true"><span role="presentation">&times;</span></button></div>');
			message_element.prependTo('body');
		}
		if(alerts.options.type === 'modal'){
			message_element = $('<div class="u-backdrop js-alertAnim"></div><div class="Alert--modal Alert--' + alerts.options.status + ' js-alertAnim" data-element-type="modal"><div class="Alert-message">' + alerts.options.content + '</div><button class="Button Button--primary" data-dismiss="Alert">'+ this.settings.dismiss +'</button></div>');
			message_element.appendTo('body');
		}

		this.showNotification(message_element);

		// if there is no timeout set in addMessage, or timeout = 0, don't set timeout
		if((typeof alerts.options.timeout === 'undefined')||alerts.options.timeout === 0){
			return;
		} else {
			setTimeout(function(){
				alerts.onTimeoutNotification(message_element);
			},alerts.options.timeout);
		}
	},

	/**
	* Method for showing the messages
	*/
	showNotification: function(element) {

		var $notification = element;

		// Use animate({ marginTop: 0 }),0) to create a chain, which makes the
		// css animation go sweet and smooth
		$notification.animate({ marginTop: 0 },0).addClass('js-'+ messages.options.type +'-alertAnim--show');
		if(messages.options.type === 'modal'){
			$('.u-backdrop').addClass('js-modal-alertAnim--show');
		}
	},

	/**
	* Method for hiding the message
	*/
	hideNotification: function(event) {

		// TO DO: @MARIJN': I've added 'data-dismiss="Alert"' to all close
		// buttons; yes it are buttons now, because the close 'links' don't go
		// anywhere, but I think this way of using buttons is nice... look for
		// yourself!
		var elementtype = $(event.target).parents('.js-dismissable').attr('data-element-type');
		var $notification = $(event.target).parents('.js-dismissable');

		// Add ontransition end event handler to remove classes and such.

		// remove and set classes for css animation
		$notification.removeClass('js-'+ elementtype +'-alertAnim--show').addClass('js-'+ elementtype +'-alertAnim--hide');
		if(messages.options.type === 'modal'){
			$('.u-backdrop').first().removeClass('js-modal-alertAnim--show').addClass('js-modal-alertAnim--hide'); // Use first, because we possibly have more than one modal
		}

		// remove dom element, after a timeout
		setTimeout(function() {
			$notification.remove();
			if(elementtype === 'modal'){
				$('.u-backdrop').first().remove(); // Use first, because we possibly have more than one modal
			}
		}, 2000);

		return false;
	},

	onTimeoutNotification: function(element) {
		element.find('.js-dismiss').click();
	}
};
