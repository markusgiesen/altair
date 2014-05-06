module.exports = function(grunt) {

	grunt.config('sass', {
		dist: {
			options: {
				outputStyle: 'nested', // nested or compressed
				sourceComments: 'none', // none, normal or map
				sourceMap: false, // enable/disable Source Maps
			},
			files: {
				'<%= project.styles_dev %>/main.concat.css': '<%= project.styles_scss %>/main.scss', // destination: source
				'<%= project.styles_dev %>/mobile.concat.css': '<%= project.styles_scss %>/mobile.scss',
				'<%= project.styles_dev %>/print.concat.css': '<%= project.styles_scss %>/print.scss',
			},
		},
		debug: {
			options: {
				outputStyle: 'nested', // nested or compressed
				sourceComments: 'map', // none, normal or map
				sourceMap: true, // enable/disable Source Maps
			},
			files: {
				'<%= project.styles_dev %>/main.concat.css': '<%= project.styles_scss %>/main.scss', // destination: source
				'<%= project.styles_dev %>/mobile.concat.css': '<%= project.styles_scss %>/mobile.scss',
				'<%= project.styles_dev %>/print.concat.css': '<%= project.styles_scss %>/print.scss',
			},
		},
	});

};
