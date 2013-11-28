/**
 * Gruntfile.js
 */

module.exports = function(grunt) {

	// Dynamically load npm tasks
	require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

	// Project Grunt config
	grunt.initConfig({

		pkg: grunt.file.readJSON('package.json'),

		// Set project info
		project: {
			src: 'assets',
			styles: '<%= project.src %>/stylesheets',
			styles_scss: '<%= project.styles %>/scss',
			styles_dev: '<%= project.styles %>/dev',
			styles_min: '<%= project.styles %>/min',
			scripts: '<%= project.src %>/javascript',
			scripts_dev: '<%= project.src %>/javascript/dev',
			scripts_min: '<%= project.src %>/javascript/min',
			design_assets: 'design/assets',
		},

		// Set js files and order
		jsfiles: {
			head: [
				'<%= project.scripts %>/vendor/modernizr.dev.js',
				// '<%= project.scripts %>/vendor/modernizr.min.js',
				'<%= project.scripts %>/head.scripts.js',
			],
			main: {
				plugins: [
					'<%= project.scripts %>/plugins/jquery.appendaround.js',
					'<%= project.scripts %>/plugins/jquery.cookie.js',
					'<%= project.scripts %>/plugins/jquery.externalize.js',
					'<%= project.scripts %>/plugins/jquery.resizethrottle.js',
					'<%= project.scripts %>/plugins/signals.js',
					'<%= project.scripts %>/plugins/crossroads.js',
					// '<%= project.scripts %>/plugins/spin.js',
					// '<%= project.scripts %>/plugins/jquery.flexslider.js',
					// '<%= project.scripts %>/plugins/garlic.js',
				],
				other: [
				// Utils
					'<%= project.scripts %>/utils/alerts.util.js',
				// Classes
					'<%= project.scripts %>/classes/appendaround.jquery.class.js',
					'<%= project.scripts %>/classes/popup.jquery.class.js',
					'<%= project.scripts %>/classes/scroll.jquery.class.js',
					'<%= project.scripts %>/classes/routing.class.js',
					// '<%= project.scripts %>/classes/flexslider.jquery.class.js',
					// '<%= project.scripts %>/classes/garlic.class.js',
					// '<%= project.scripts %>/classes/spin.class.js',
					// '<%= project.scripts %>/classes/togglelist.jquery.class.js',
					// '<%= project.scripts %>/classes/verticalgrid.jquery.class.js',
				// Main
					'<%= project.scripts %>/main.scripts.js',
				],
			},
			mobile: {
				plugins: [
					'<%= project.scripts %>/plugins/hide.address.bar.js',
					'<%= project.scripts %>/vendor/zepto.min.js',
					'<%= project.scripts %>/plugins/zepto.scroll.js',
					'<%= project.scripts %>/plugins/zepto.cookie.js',
					'<%= project.scripts %>/plugins/signals.js',
					'<%= project.scripts %>/plugins/crossroads.js',
					// '<%= project.scripts %>/plugins/ios.orientation.fix.js',
					// '<%= project.scripts %>/vendor/zepto.data.min.js',
					// '<%= project.scripts %>/plugins/swipe.js',
					// '<%= project.scripts %>/plugins/garlic.js',
				],
				other: [
				// Utils
					'<%= project.scripts %>/utils/alerts.util.js',
				// Classes
					'<%= project.scripts %>/classes/scroll.zepto.class.js',
					'<%= project.scripts %>/classes/swipe.class.js',
					'<%= project.scripts %>/classes/togglelist.zepto.class.js',
					'<%= project.scripts %>/classes/routing.class.js',
					// '<%= project.scripts %>/classes/garlic.class.js',
				// Main
					'<%= project.scripts %>/mobile.scripts.js',
				],
			},
		},

		// Project banner (dynamically appended to css/js files; inherited from package.json)
		tag: {
			banner: '/**\n' +
					' * <%= pkg.name %>\n' +
					' *\n' +
					' * <%= pkg.description %>\n' +
					' *\n' +
					' * @authors\t<%= pkg.author %>\n' +
					' * @copyright\t<%= grunt.template.today("yyyy") %> <%= pkg.copyright %>\n' +
					' * @link\t<%= pkg.url %>\n' +
					' * @version\t<%= pkg.version %>\n' +
					' * @generated\t<%= grunt.template.today("yyyy-mm-dd:hh:mm") %>\n' +
					' */\n'
		},

		// Scss
		sass: {
			dist: {
				options: {
					require: 'sass-globbing', // require a (or multiple) Ruby library before running Sass
					style: 'expanded', // nested, compact, compressed or expanded
					cacheLocation: '.sass-cache', // path to put cached Sass files
				},
				files: {
					'<%= project.styles_dev %>/main.concat.css': '<%= project.styles_scss %>/main.scss', // destination: source
					'<%= project.styles_dev %>/mobile.concat.css': '<%= project.styles_scss %>/mobile.scss',
					'<%= project.styles_dev %>/ie.concat.css': '<%= project.styles_scss %>/ie.scss',
					'<%= project.styles_dev %>/print.dev.css': '<%= project.styles_scss %>/print.scss',
				},
			},
			debug: {
				options: {
					require: 'sass-globbing', // require a (or multiple) Ruby library before running Sass
					style: 'expanded', // nested, compact, compressed or expanded
					sourcemap: false, // enable Source Maps (requires Sass 3.3.0, which can be installed with `gem install sass --pre`)
					trace: false, // show a full traceback on error
					debugInfo: true, // for FireSass Firebug plugin
					lineNumbers: true, // indicate corresponding source line
					cacheLocation: '.sass-cache', // path to put cached Sass files
				},
				files: {
					'<%= project.styles_dev %>/main.concat.css': '<%= project.styles_scss %>/main.scss', // destination: source
					'<%= project.styles_dev %>/mobile.concat.css': '<%= project.styles_scss %>/mobile.scss',
					'<%= project.styles_dev %>/ie.concat.css': '<%= project.styles_scss %>/ie.scss',
					'<%= project.styles_dev %>/print.dev.css': '<%= project.styles_scss %>/print.scss',
				},
			},
		},

		// Add vendor prefixes
		autoprefixer: {
			options: {
				browsers: ['> 1%', 'last 2 versions', 'ff 17', 'opera 12.1'], // Default value
				// browsers: ['last 2 version', 'ie 8', 'ie 7'],
			},
			// files: {
				// expand: true,
				// flatten: true,
				// src: ['<%= project.styles_dev %>/*.css', '!<%= project.styles_dev %>/ie.css'],
				// dest: '<%= project.styles_dev %>/',
			// },
			main: {
				src: '<%= project.styles_dev %>/main.concat.css', // source
				dest: '<%= project.styles_dev %>/main.dev.css', // destination
			},
			mobile: {
				src: '<%= project.styles_dev %>/mobile.concat.css',
				dest: '<%= project.styles_dev %>/mobile.dev.css',
			},
			oldie: {
				options: {
					browsers: ['ie 7', 'ie 8'],
				},
				src: '<%= project.styles_dev %>/ie.concat.css',
				dest: '<%= project.styles_dev %>/ie.dev.css',
			},
		},

		// Minify css
		csso: {
			compress: {
				options: {
					banner: '<%= tag.banner %>',
				},
				files:
				{
					// define seperate files, because csso doesn't handle wildcards (yet?!)
					'<%= project.styles_min %>/main.min.css': '<%= project.styles_dev %>/main.dev.css', // destination: source
					'<%= project.styles_min %>/mobile.min.css': '<%= project.styles_dev %>/mobile.dev.css',
					'<%= project.styles_min %>/ie.min.css': '<%= project.styles_dev %>/ie.dev.css',
					'<%= project.styles_min %>/print.min.css': '<%= project.styles_dev %>/print.dev.css',
				},
			},
		},

		// Concatenate js
		concat: {
			options: {
				nonull: true,
				separator: '',
				stripBanners: true,
			},
			dist: {
				options: {
					banner: '<%= tag.banner %>',
				},
				files: {
					'<%= project.scripts_dev %>/head.scripts.dev.js': '<%= jsfiles.head %>', // destination: source
					'<%= project.scripts_dev %>/main.scripts.dev.js': ['<%= jsfiles.main.plugins %>', '<%= jsfiles.main.other %>'],
					'<%= project.scripts_dev %>/mobile.scripts.dev.js': ['<%= jsfiles.mobile.plugins %>', '<%= jsfiles.mobile.other %>'],
				},
			},
			forhint: {
				files: {
					'<%= project.scripts_dev %>/head.scripts.hint.js': '<%= project.scripts %>/head.scripts.js',
					'<%= project.scripts_dev %>/main.scripts.hint.js': '<%= jsfiles.main.other %>',
					'<%= project.scripts_dev %>/mobile.scripts.hint.js': '<%= jsfiles.mobile.other %>',
				},
			},
		},

		// Hint js
		jshint: {
			options : {
				boss:      true,
				browser:   true,
				// camelcase: true,
				curly:     true,
				eqeqeq:    true,
				eqnull:    true,
				// es5:       true,
				// esnext:    true,
				immed:     true,
				// indent:    2,
				latedef:   true,
				// node:      true,
				newcap:    true,
				noarg:     true,
				quotmark:  'single',
				// regexp:    true,
				// smarttabs: true,
				// strict:    true,
				sub:       true,
				trailing:  false,
				// undef:     true,
				unused:    true,
				globals: {
					// AMD
					module:     true,
					require:    true,
					define:     true,

					// Environments
					console:    true,
					alert:      false,

					// General Purpose Libraries
					$:          true,
					jQuery:     true,
					Modernizr:  true,
				},
			},
			dist: [
				'Gruntfile.js',
				'<%= project.scripts_dev %>/*.hint.js',
			],
		},

		// Minify js
		uglify: {
			options: {
				mangle: false, // Set to false to prevent changes to your variable and function names
				banner: '<%= tag.banner %>',
			},
			dist: {
				files: {
					'<%= project.scripts_min %>/head.scripts.min.js': '<%= project.scripts_dev %>/head.scripts.dev.js', // destination: source
					'<%= project.scripts_min %>/main.scripts.min.js': '<%= project.scripts_dev %>/main.scripts.dev.js',
					'<%= project.scripts_min %>/mobile.scripts.min.js': '<%= project.scripts_dev %>/mobile.scripts.dev.js',
				},
			},
		},

		// MD5 hash(ifies) assets
		hashify: {
			options: {
				basedir: '', // hashmap and dest path will be relative to this dir
				copy: false, // keep originals
			},
			styles: {
				options: {
					hashmap: '<%= project.styles_min %>/hash.css.json', // location to put hashmap
				},
				files: [
					{
						src: '<%= project.styles_min %>/main.min.css', // md5 of the contents goes in hashmap
						dest: '<%= project.styles_min %>/{{hash}}.css', // {{hash}} will be replaced with md5 of the contents of the source
						key: 'main', // key to use in the hashmap
					},
					{
						src: '<%= project.styles_min %>/mobile.min.css',
						dest: '<%= project.styles_min %>/{{hash}}.css',
						key: 'mobile',
					},
					{
						src: '<%= project.styles_min %>/ie.min.css',
						dest: '<%= project.styles_min %>/{{hash}}.css',
						key: 'oldie',
					},
					{
						src: '<%= project.styles_min %>/print.min.css',
						dest: '<%= project.styles_min %>/{{hash}}.css',
						key: 'print',
					},
				],
			},
			scripts: {
				options: {
					hashmap: '<%= project.scripts_min %>/hash.js.json', // location to put hashmap
				},
				files: [
					{
						src: '<%= project.scripts_min %>/head.scripts.min.js',
						dest: '<%= project.scripts_min %>/{{hash}}.js',
						key: 'head',
					},
					{
						src: '<%= project.scripts_min %>/main.scripts.min.js',
						dest: '<%= project.scripts_min %>/{{hash}}.js',
						key: 'main',
					},
					{
						src: '<%= project.scripts_min %>/mobile.scripts.min.js',
						dest: '<%= project.scripts_min %>/{{hash}}.js',
						key: 'mobile',
					},
				],
			},
		},

		// Optimize images (jpg, png and gif)
		imageoptim: {
			options: {
				quitAfter: false,
			},
			jpgs: {
				options: {
					jpegMini: true,
					imageAlpha: false,
				},
				src: [
					// '<%= project.src %>/images/*.jpg',
					// '<%= project.styles %>/img/*.jpg',
					'content/**/*.jpg'
				],
			},
			pngs: {
				options: {
					jpegMini: false,
					imageAlpha: true,
				},
				src: [
					// '<%= project.src %>/images/*.png',
					// '<%= project.styles %>/img/*.png',
					'content/**/*.png'
				],
			},
		},

		// Optimize svg (pre Grunticon)
		svgmin: {
			options: {
				plugins: [{
					removeViewBox: false,
				}],
			},
			dist: {
				files: [{
					expand: true,
					cwd: '<%= project.design_assets %>/svg',
					src: ['*.svg'],
					dest: '<%= project.design_assets %>/svg/min/',
					ext: '.svg',
				}],
			},
		},

		// Grunticon
		grunticon: {
			icons: {
				options: {
					src: '<%= project.design_assets %>/svg/min/',
					dest: '<%= project.styles_scss %>/grunticon',
					svgo: false, // Use svgmin instead! SVGO will be removed in future versions.
					pngcrush: false,
					datasvgcss: '_data-svg.scss',
					datapngcss: '_data-png.scss',
					urlpngcss: '_fallback-png.scss',
					pngfolder: '../../img/',
					cssprefix: 'grunt-',
					previewhtml: false,
					loadersnippet: false,
				},
			},
		},

		// Clean dirs
		clean: {
			assets: {
				src: [
					'<%= project.styles_dev %>/*.concat.css',
					'<%= project.styles_min %>/*.css',
					'<%= project.scripts_dev %>/*.hint.js',
					'<%= project.scripts_min %>/*.js',
				],
			},
			grunticon: {
				src: [
					'<%= project.styles_scss %>/grunticon/grunticon*.txt',
					'<%= project.styles_scss %>/grunticon/preview.html',
					'<%= project.styles_scss %>/img', // Remove for now!
				],
			},
		},

		bump: {
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
		},

		// Watch
		watch: {
			styles: {
				files: ['<%= project.styles_scss %>/**/*.scss'],
				tasks: ['sass:dist', 'autoprefixer'],
			},
			scripts: {
				files: [
					'<%= project.scripts %>/*.js',
					'<%= project.scripts %>/classes/*.js',
					'<%= project.scripts %>/plugins/*.js',
					'<%= project.scripts %>/utils/*.js',
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
					'content/**/*.txt',
					'content/**/*.md',
				],
			},
		},
	});

	// Default task (run: `grunt` from command line for this task to take effect)
	grunt.registerTask('default', [
		'svgmin',
		'grunticon',
		'clean:grunticon',
		'sass:debug',
		'autoprefixer',
		'concat:forhint',
		'concat:dist',
		'jshint:dist',
		'watch',
	]);

	// Images task (run: `grunt images` from command line for this task to take effect)
	grunt.registerTask('images', [
		'imageoptim:jpgs',
		'imageoptim:pngs',
	]);

	// Build task (run: `grunt build` from command line for this task to take effect)
	grunt.registerTask('build', [
		'bump-only:patch',
		'svgmin',
		'grunticon',
		'clean:grunticon',
		'clean:assets',
		'sass:dist',
		'autoprefixer',
		'csso',
		'concat:dist',
		'uglify',
		'hashify',
	]);

	// Build task (run: `grunt release` from command line for this task to take effect)
	grunt.registerTask('release', [
		'bump-only:minor',
		'bump-commit',
		'svgmin',
		'grunticon',
		'clean:grunticon',
		'clean:assets',
		'sass:dist',
		'autoprefixer',
		'csso',
		'concat:dist',
		'uglify',
		'hashify',
	]);
};
