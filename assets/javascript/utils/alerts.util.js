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
		$('body').on('click', '[data-dismiss]', this.hideNotification );

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
			message_element = $('<div class="Alert Alert--bar Alert--' + alerts.options.status + ' js-alert" data-element-type="bar"><div class="Alert-message">' + alerts.options.content + '</div><button type="button" class="Alert-close" data-dismiss="Alert" aria-hidden="true" role="presentation">&times;</button></div>');
			message_element.prependTo('body');
		}
		if(alerts.options.type === 'modal'){
			message_element = $('<div class="Backdrop js-backdrop"></div><div class="Alert Alert--modal Alert--' + alerts.options.status + ' js-alert" data-element-type="modal"><div class="Alert-message">' + alerts.options.content + '</div><button class="Button Button--primary" data-dismiss="Alert">'+ this.settings.dismiss +'</button></div>');
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
		$notification.animate({ marginTop: 0 },0).addClass('is-visible');
		if(alerts.options.type === 'modal'){
			$('.Backdrop').addClass('is-visible');
		}
	},

	/**
	* Method for hiding the message
	*/
	hideNotification: function(event) {

		var dismissselector = $(event.target).attr('data-dismiss');
		var $notification = $(event.target).parents('.'+dismissselector);

		// remove and set classes for css animation
		$notification.removeClass('is-visible').addClass('is-hidden');
		if(alerts.options.type === 'modal'){
			$('.Backdrop').first().removeClass('is-visible').addClass('is-hidden'); // Use first, because we possibly have more than one modal
		}

		var notificationHasTransformSet = null;
		var notificationHasWebkitTransformSet = null;

		// Get the transform of an element via getComputedStyle (if the browser supports this..)
		if (window.getComputedStyle) {
			notificationHasTransformSet = window.getComputedStyle($notification.get(0), null).getPropertyValue('transform');
			notificationHasWebkitTransformSet = window.getComputedStyle($notification.get(0), null).getPropertyValue('-webkit-transform');
		}

		// If browser doesn't support transitions or there is no transform (or -webkit-transform...) set
		if(!Modernizr.csstransitions || notificationHasTransformSet === 'none' || notificationHasWebkitTransformSet === 'none'){
			alerts.removeNotificationElements($notification);
		}
		else {
			// Wait for transition to end
			$notification.on(transitionEnd, function(){
				alerts.removeNotificationElements($(this));
			});
		}

		return false;
	},

	removeNotificationElements: function(element) {
		var elementtype = element.attr('data-element-type');
		element.remove();
		if(elementtype === 'modal'){
			$('.Backdrop').first().remove(); // Use first, because we possibly have more than one modal
		}
	},

	onTimeoutNotification: function(element) {
		element.find('[data-dismiss]').click();
	}
};
