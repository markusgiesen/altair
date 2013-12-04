/**
 * head.script.js
 *
 * Essential scripts, to be loaded in the head of the document
 * Only import (prepend) scripts. No additional scripting!
 */

/**
 * Modernizr
 *
 * Enable the use of Modernizr, by adding (out-commenting) the correct line in
 * the Gruntfile.js in the 'head' part of the 'Set js files and order' section.
 *
 * Make sure to use a custom build of Modernizr, only with the necssary
 * tests needed for production environment: http://modernizr.com/download/
 */

// "assets/javascript/vendor/modernizr.dev.js",
// "assets/javascript/vendor/modernizr.min.js",

/**
 * Typekit
 *
 * Enable the use of Typekit font, by adding (out-commenting) it in the
 * Gruntfile.js in the 'Set js files and order' section.
 *
 * Load Typekit fonts asynchronously with controlling the Flash of
 * Unstyled Text (FOUT) using Font Events (.wf-loading, etc.).
 *
 * Make sure to set the Typekit account id in typekit.min.js
 */

// "assets/javascript/vendor/typekit.min.js",

/**
 * WebFont Loader
 *
 * Load custom, Google, Ascender, Fonts.com (Monotype), Fontdeck and/or
 * Typekit web fonts (or from multiple) with Google's WebFont Loader.
 * Version of webfont.min.js: 1.5.0 (check: http://j.mp/1475wC9).
 *
 * Enable the use of WebFont Loader, by adding (out-commenting) the correct
 * line in the Gruntfile.js in the 'head' part of the 'Set js files and
 * order' section. Then out-comment the code snippet below and use the webfont
 * service of your choice or use custom (sef-hosted) web fonts!
 */

// "assets/javascript/vendor/webfont.min.js",

//WebFont.load({
//	google: { families: ['Fontname1', 'Fontname2']},
//	ascender: { key:'xxxxxxx', families: ['Fontname:bold,bolditalic,italic,regular']},
//	monotype: { projectId: 'xxxxxxx'},
//	fontdeck: { id: 'xxxxx'},
//	typekit: { id: 'xxxxxxx'},
//	custom: {
//		families:['TeXGyreAdventor-Bold', 'TeXGyreAdventor-Regular'],
//		urls:['<?php echo url('/assets/webfonts/texgyreadventor/texgyreadventor.css'); ?>']
//	}
//});

/**
 * ReSRC.it
 *
 * Load the ReSRC script asynchronously. ReSRC delivers responsive images
 * on-demand, direct from the cloud.
 * For more information see: http://www.resrc.it/support
 */

//(function(d, t){
//	var r = d.createElement(t),
//	s = d.getElementsByTagName(t)[0];
//	r.src = '//use.resrc.it';
//	s.parentNode.insertBefore(r, s);
//}(document, 'script'));
