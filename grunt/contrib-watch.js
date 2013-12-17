module.exports = function(grunt) {

	grunt.config('watch', {
		styles: {
			files: ['<%= project.styles_scss %>/**/*.scss'],
			tasks: ['sass:dist', 'autoprefixer'],
		},
		scripts: {
			files: [
				'<%= project.scripts %>/*.js',
				'<%= project.scripts %>/classes/*.js',
				'<%= project.scripts %>/plugins/*.js',
				'<%= project.scripts %>/vendor/*.js',
			],
			tasks: ['concat:forhint', 'concat:dist'],
		},
		hinting: {
			files: ['<%= project.scripts_dev %>/*.js'],
			tasks: ['jshint:dist'],
		},
		svg: {
			files: ['<%= project.design_assets %>/svg/*.svg'],
			tasks: ['svgmin','grunticon','clean:grunticon'],
		},
		livereload: {
			options: { livereload: true },
			files: [
				'<%= project.styles_dev %>/main.dev.css',
				'<%= project.scripts_dev %>/head.scripts.dev.js',
				'<%= project.scripts_dev %>/main.scripts.dev.js',
				'site/templates/*.php',
				'site/snippets/*.php',
				// 'content/**/*.txt', // This results in a grunt error. If you want to use this, use command: $ launchctl limit maxfiles 2048 2048 to set a file limit. (source: http://superuser.com/questions/261023/how-to-change-default-ulimit-values-in-mac-os-x-10-6)
				// 'content/**/*.md',
			],
		},
	});

	grunt.loadNpmTasks('grunt-contrib-watch');

};
