/**
 * Disable hover and pointer events, is set with JS, on scroll!
 * Use css (located in base.scss) to actually disable pointer events.
 *
 * For info see: http://www.thecssninja.com/javascript/pointer-events-60fps
 */

var body = document.body,
timer;

window.addEventListener('scroll', function() {
	clearTimeout(timer);

	if(!body.classList.contains('js-disable-hover')) {
		body.classList.add('js-disable-hover');
	}

	timer = setTimeout(function(){
		body.classList.remove('js-disable-hover');
	},75);
}, false);
