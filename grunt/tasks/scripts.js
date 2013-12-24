module.exports = function(grunt) {

	grunt.registerTask('js', [], function () {
		grunt.loadNpmTasks('grunt-contrib-concat');
		grunt.loadNpmTasks('grunt-contrib-jshint');
		grunt.loadNpmTasks('grunt-contrib-watch');
		grunt.task.run(
			'concat:forhint',
			'concat:dist'
		);
	});

	grunt.registerTask('scripts', [], function () {
		grunt.loadNpmTasks('grunt-contrib-concat');
		grunt.loadNpmTasks('grunt-contrib-jshint');
		grunt.loadNpmTasks('grunt-contrib-watch');
		grunt.task.run(
			'js',
			'jshint:dist',
			'watch'
		);
	});

};
