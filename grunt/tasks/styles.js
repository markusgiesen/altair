module.exports = function(grunt) {

	grunt.registerTask('sass-concat', [], function () {
		grunt.loadNpmTasks('grunt-contrib-sass');
		grunt.loadNpmTasks('grunt-autoprefixer');
		grunt.task.run(
			'sass:debug',
			'autoprefixer'
		);
	});

	grunt.registerTask('sass-minify', [], function () {
		grunt.loadNpmTasks('grunt-contrib-clean');
		grunt.loadNpmTasks('grunt-csso');
		grunt.task.run(
			'clean:styles',
			'csso'
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
