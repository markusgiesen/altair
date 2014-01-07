module.exports = function(grunt) {

	grunt.registerTask('concat', [], function () {
		grunt.loadNpmTasks('grunt-contrib-concat');
		grunt.task.run(
			'concat:forhint',
			'concat:dist'
		);
	});

	grunt.registerTask('hint', [], function () {
		grunt.loadNpmTasks('grunt-contrib-jshint');
		grunt.task.run(
			'jshint:dist'
		);
	});

	grunt.registerTask('scripts', [], function () {
		grunt.loadNpmTasks('grunt-contrib-concat');
		grunt.loadNpmTasks('grunt-contrib-jshint');
		grunt.loadNpmTasks('grunt-contrib-watch');
		grunt.task.run(
			'concat',
			'hint',
			'watch'
		);
	});

};
