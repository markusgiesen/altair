module.exports = function(grunt) {

	grunt.config('autoprefixer', {
		options: {
			browsers: ['> 1%', 'last 2 versions', 'ff 17', 'opera 12.1'], // Default value
			// browsers: ['last 2 version', 'ie 8', 'ie 7'],
		},
		main: {
			src: '<%= project.styles_dev %>/main.concat.css', // source
			dest: '<%= project.styles_dev %>/main.dev.css', // destination
		},
		mobile: {
			src: '<%= project.styles_dev %>/mobile.concat.css',
			dest: '<%= project.styles_dev %>/mobile.dev.css',
		},
		oldie: {
			options: {
				browsers: ['ie 7', 'ie 8'],
			},
			src: '<%= project.styles_dev %>/ie.concat.css',
			dest: '<%= project.styles_dev %>/ie.dev.css',
		},
	});

};
