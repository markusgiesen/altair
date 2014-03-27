module.exports = function(grunt) {

	grunt.config('sass', {
		dist: {
			options: {
				style: 'expanded', // nested, compact, compressed or expanded
				precision: 6, // how many digits of precision to use when outputting decimal numbers (default is 3)
				sourcemap: false, // enable Source Maps (requires Sass 3.3.0, which can be installed with `gem install sass --pre`)
				cacheLocation: '.sass-cache', // path to put cached Sass files
			},
			files: {
				'<%= project.styles_dev %>/main.concat.css': '<%= project.styles_scss %>/main.scss', // destination: source
				'<%= project.styles_dev %>/mobile.concat.css': '<%= project.styles_scss %>/mobile.scss',
				'<%= project.styles_dev %>/ie.concat.css': '<%= project.styles_scss %>/ie.scss',
				'<%= project.styles_dev %>/print.concat.css': '<%= project.styles_scss %>/print.scss',
			},
		},
		debug: {
			options: {
				style: 'expanded', // nested, compact, compressed or expanded
				precision: 6, // how many digits of precision to use when outputting decimal numbers (default is 3)
				sourcemap: true, // enable Source Maps (requires Sass 3.3.2+)
				lineNumbers: false, // emit comments in the generated CSS indicating the corresponding source line.
				// debugInfo: false, // emit extra information in the generated CSS that can be used by the FireSass Firebug plugin
				cacheLocation: '.sass-cache', // path to put cached Sass files
			},
			files: {
				'<%= project.styles_dev %>/main.concat.css': '<%= project.styles_scss %>/main.scss', // destination: source
				'<%= project.styles_dev %>/mobile.concat.css': '<%= project.styles_scss %>/mobile.scss',
				'<%= project.styles_dev %>/ie.concat.css': '<%= project.styles_scss %>/ie.scss',
				'<%= project.styles_dev %>/print.concat.css': '<%= project.styles_scss %>/print.scss',
			},
		},
	});

};
