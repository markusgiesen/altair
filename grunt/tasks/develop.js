module.exports = function(grunt) {

	grunt.registerTask('develop', [], function () {
		grunt.loadNpmTasks('grunt-contrib-sass');
		grunt.loadNpmTasks('grunt-autoprefixer');
		grunt.loadNpmTasks('grunt-contrib-concat');
		grunt.loadNpmTasks('grunt-contrib-jshint');
		grunt.loadNpmTasks('grunt-contrib-watch');
		grunt.task.run(
			'sass:debug',
			'autoprefixer',
			'concat:forhint',
			'concat:dist',
			'jshint:dist',
			'watch'
		);
	});

};
