module.exports = function(grunt) {

	grunt.config('concat', {
		options: {
			nonull: true,
			separator: '',
			stripBanners: true,
		},
		dist: {
			options: {
				banner: '<%= tag.banner %>',
			},
			files: {
				'<%= project.scripts_dev %>/head.scripts.dev.js': '<%= jsfiles.head %>', // destination: source
				'<%= project.scripts_dev %>/main.scripts.dev.js': ['<%= jsfiles.main.plugins %>', '<%= jsfiles.main.other %>'],
				'<%= project.scripts_dev %>/mobile.scripts.dev.js': ['<%= jsfiles.mobile.plugins %>', '<%= jsfiles.mobile.other %>'],
			},
		},
		forhint: {
			files: {
				'<%= project.scripts_dev %>/head.scripts.hint.js': '<%= project.scripts %>/head.scripts.js',
				'<%= project.scripts_dev %>/main.scripts.hint.js': '<%= jsfiles.main.other %>',
				'<%= project.scripts_dev %>/mobile.scripts.hint.js': '<%= jsfiles.mobile.other %>',
			},
		},
	});

};
