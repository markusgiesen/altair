module.exports = function(grunt) {

	grunt.config('jshint', {

		dist: {
			options : {
				jshintrc: '.jshintrc',
				reporter: require('jshint-stylish'),
			},
			src: [
				'Gruntfile.js',
				'<%= project.scripts_dev %>/*.hint.js',
			],
		},

	});

	grunt.loadNpmTasks('grunt-contrib-jshint');

};

// More settings for .jshintrc
	// "camelcase": true,
	// "es5":       true,
	// "esnext":    true,
	// "indent":    2,
	// "regexp":    true,
	// "smarttabs": true,
	// "strict":    true,
	// "undef":     true,
