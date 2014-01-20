module.exports = function(grunt) {

	grunt.registerTask('develop', [], function () {
		grunt.loadNpmTasks('grunt-contrib-watch');
		grunt.task.run(
			'sass-concat',
			'scripts-concat',
			'scripts-hint',
			'watch'
		);
	});

};
