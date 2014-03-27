module.exports = function(grunt) {

	grunt.config('node-sass', {
		dist: {
			options: {
				outputStyle: 'expanded', // nested, compact, expanded or compressed
				sourceComments: 'map', // none, normal or map
				sourceMap: false, // enable/disable Source Maps
			},
			files: {
				'<%= project.styles_dev %>/main.concat.css': '<%= project.styles_scss %>/main.scss', // destination: source
				// '<%= project.styles_dev %>/mobile.concat.css': '<%= project.styles_scss %>/mobile.scss',
				// '<%= project.styles_dev %>/ie.concat.css': '<%= project.styles_scss %>/ie.scss',
				// '<%= project.styles_dev %>/print.concat.css': '<%= project.styles_scss %>/print.scss',
			},
		},
		debug: {
			options: {
				outputStyle: 'expanded', // nested, compact, compressed or expanded
				sourceComments: 'map', // none, normal or map
				sourceMap: true, // enable/disable Source Maps
			},
			files: {
				'<%= project.styles_dev %>/main.concat.css': '<%= project.styles_scss %>/main.scss', // destination: source
				// '<%= project.styles_dev %>/mobile.concat.css': '<%= project.styles_scss %>/mobile.scss',
				// '<%= project.styles_dev %>/ie.concat.css': '<%= project.styles_scss %>/ie.scss',
				// '<%= project.styles_dev %>/print.concat.css': '<%= project.styles_scss %>/print.scss',
			},
		},
	});

};
