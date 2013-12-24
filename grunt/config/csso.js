module.exports = function(grunt) {

	grunt.config('csso', {
		compress: {
			options: {
				banner: '<%= tag.banner %>',
			},
			files:
			{
				// define seperate files, because csso doesn't handle wildcards (yet?!)
				'<%= project.styles_min %>/main.min.css': '<%= project.styles_dev %>/main.dev.css', // destination: source
				'<%= project.styles_min %>/mobile.min.css': '<%= project.styles_dev %>/mobile.dev.css',
				'<%= project.styles_min %>/ie.min.css': '<%= project.styles_dev %>/ie.dev.css',
				'<%= project.styles_min %>/print.min.css': '<%= project.styles_dev %>/print.dev.css',
			},
		},
	});

};
