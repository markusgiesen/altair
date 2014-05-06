module.exports = function(grunt) {

	grunt.config('stripmq', {
		options: {
			width: '0em',
			type: 'screen'
		},
		dist: {
			files: {
				'<%= project.styles_dev %>/oldie.concat.css': '<%= project.styles_dev %>/main.dev.css', // destination: [source]
			},
		},
	});

};
