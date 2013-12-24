module.exports = function(grunt) {

	grunt.registerTask('release', [], function () {
		grunt.loadNpmTasks('grunt-bump');
		grunt.loadNpmTasks('grunt-contrib-sass');
		grunt.loadNpmTasks('grunt-autoprefixer');
		grunt.loadNpmTasks('grunt-csso');
		grunt.loadNpmTasks('grunt-contrib-concat');
		grunt.loadNpmTasks('grunt-contrib-uglify');
		grunt.loadNpmTasks('grunt-contrib-clean');
		grunt.loadNpmTasks('grunt-hashify');
		grunt.task.run(
			'bump-only:minor', // Version bumped from 0.0.x to 0.1.0
			'bump-commit',
			'icons',
			'sass:dist',
			'autoprefixer',
			'csso',
			'concat:dist',
			'uglify',
			'clean:grunticon',
			'clean:assets',
			'hashify'
		);
	});

};
