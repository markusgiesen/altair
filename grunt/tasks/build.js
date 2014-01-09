module.exports = function(grunt) {

	grunt.registerTask('build', [], function () {
		grunt.loadNpmTasks('grunt-bump');
		grunt.loadNpmTasks('grunt-hashify');
		grunt.task.run(
			'bump-only:patch', // Version bumped from 0.0.2 to 0.0.3
			'sass-concat',
			'sass-minify',
			'scripts-concat',
			'scripts-uglify',
			'hashify'
		);
	});

};
