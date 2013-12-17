module.exports = function(grunt) {

	grunt.config('bump', {
		options: {
			files: ['package.json'],
			commit: true,
			commitMessage: 'Release v%VERSION%',
			commitFiles: ['-a'], // '-a' for all files
			createTag: true,
			tagName: 'v%VERSION%',
			tagMessage: 'Version %VERSION%',
			push: false,
		}
	});

	grunt.loadNpmTasks('grunt-bump');

};
