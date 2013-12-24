module.exports = function(grunt) {

	grunt.registerTask('sass', [], function () {
		grunt.loadNpmTasks('grunt-contrib-sass');
		grunt.loadNpmTasks('grunt-autoprefixer');
		grunt.task.run(
			'sass:dist',
			'autoprefixer'
		);
	});

	grunt.registerTask('styles', [], function () {
		grunt.loadNpmTasks('grunt-contrib-watch');
		grunt.task.run(
			'sass',
			'watch'
		);
	});

};
