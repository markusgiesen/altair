module.exports = function(grunt) {

	grunt.config('grunticon', {
		icons: {
			files: [{
				expand: true,
				cwd: '<%= project.design_assets %>/svg/min/',
				src: ['*.svg'],
				dest: '<%= project.styles_scss %>/grunticon/',
			}],
			options: {
				svgo: false, // Use svgmin instead! SVGO will be removed in future versions.
				pngcrush: false,
				datasvgcss: '_data-svg.scss',
				datapngcss: '_data-png.scss',
				urlpngcss: '_fallback-png.scss',
				pngfolder: '../img/',
				cssprefix: '%grunt-',
				defaultWidth: '300px',
				defaultHeight: '200px',
				cssbasepath: '<%= project.styles %>/',
				previewhtml: 'preview.html',
				loadersnippet: 'grunticon.loader.js',
			},
		},
	});

	grunt.loadNpmTasks('grunt-grunticon');

};
