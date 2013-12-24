module.exports = function(grunt) {

	grunt.registerTask('imageoptim', [], function () {
		grunt.loadNpmTasks('grunt-imageoptim');
		grunt.task.run(
			'imageoptim:jpgs',
			'imageoptim:pngs'
		);
	});

};
