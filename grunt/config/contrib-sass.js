module.exports = function(grunt) {

	grunt.config('sass', {
		dist: {
			options: {
				require: 'sass-globbing', // require a (or multiple) Ruby library before running Sass
				style: 'expanded', // nested, compact, compressed or expanded
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
				require: 'sass-globbing', // require a (or multiple) Ruby library before running Sass
				style: 'expanded', // nested, compact, compressed or expanded
				sourcemap: true, // enable Source Maps (requires Sass 3.3.0, which can be installed with `gem install sass --pre`)
				trace: false, // show a full traceback on error
				debugInfo: false, // for FireSass Firebug plugin
				lineNumbers: false, // indicate corresponding source line
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
