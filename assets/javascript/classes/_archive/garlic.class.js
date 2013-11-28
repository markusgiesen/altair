/**
 * Add Garlic plugin to forms
 *
 * Needs garlic.js and jquery.min.js OR zepto.data.min.js!
 * Some added functionality to include email, select and other type fields
 * https://github.com/guillaumepotier/Garlic.js
 */

var garlicForm = {

	/**
	 * Initiate the garlic plugin
	 * @param {form_element} a string for the element identifier to pass to the garlic plugin
	 * @param {exclude_element} an array of element identifiers to exclude from the garlic plugin
	 */
	init: function(form_element, exclude_element) {
		var form = form_element;
		var exclude = exclude_element;

		/* remove this when Garlic supports IE8 and 7 */
		if ($('html').hasClass('lt-ie9')) {
			return; // this is IE8 or below, abandon ship!
		} else {

			// add garlic to the following fields
			$(form).garlic({ inputs: 'input[type="text"], select, textarea, input[type="email"], input[type="radio"], input[type="checkbox"]' });

			// loop through array of excluded fields
			for (var i=0; i<exclude.length; i++){
				// destroy storage for the field
				garlicForm.destroyStorage( form +' '+ exclude[i] );
			}
		}

	},
	/**
	 * Destroys the localStorage for the field and adds eventhandler for blur
	 * @param {element} a string for the element identifier to destroy
	 */
	destroyStorage: function(element){
		var input = element;
		$(input).garlic('destroy'); // destroy local storage var
		$(input).on('blur', garlicForm.destroyStorageBlur ); // onblur of no-persist, delete local storage
	},
	/**
	 * Destroys the localStorage for the field, used onblur, so no sensitive information is saved
	 * @param {element} a string for the element identifier to destroy
	 */
	destroyStorageBlur: function(element){
		$(element.target).garlic('destroy');
	}

};
