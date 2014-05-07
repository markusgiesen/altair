module.exports = function(grunt) {

	grunt.registerTask('oldie', [], function () {
		grunt.loadNpmTasks('grunt-stripmq');
		grunt.loadNpmTasks('grunt-pixrem');
		grunt.loadNpmTasks('grunt-notify');
		grunt.task.run(
			'sass-concat',
			'stripmq',
			'pixrem',
			'notify:oldie'
		);
	});

};
