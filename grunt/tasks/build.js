module.exports = function(grunt) {

	grunt.registerTask('build', [], function () {
		grunt.loadNpmTasks('grunt-bump');
		grunt.loadNpmTasks('grunt-contrib-sass');
		grunt.loadNpmTasks('grunt-autoprefixer');
		grunt.loadNpmTasks('grunt-csso');
		grunt.loadNpmTasks('grunt-contrib-concat');
		grunt.loadNpmTasks('grunt-contrib-uglify');
		grunt.loadNpmTasks('grunt-contrib-clean');
		grunt.loadNpmTasks('grunt-hashify');
		grunt.task.run(
			'bump-only:patch', // Version bumped from 0.0.2 to 0.0.3
			'icons',
			'sass:dist',
			'autoprefixer',
			'clean:assets',
			'csso',
			'concat:dist',
			'uglify',
			'hashify'
		);
	});

};
