module.exports = function(grunt) {

	// Initialize config
	grunt.initConfig({

		// Load package.json
		pkg: require('./package.json'),

		// Project paths
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

		// Project banner
		tag: {
			banner: '/**\n' +
					' * <%= pkg.name %>\n' +
					' *\n' +
					' * <%= pkg.description %>\n' +
					' *\n' +
					' * @authors\t<%= pkg.author %>\n' +
					// ' * @copyright\t<%= grunt.template.today("yyyy") %> <%= pkg.copyright %>\n' +
					' * @license\t<%= pkg.license %>\n' +
					' * @link\t<%= pkg.url %>\n' +
					' * @version\t<%= pkg.version %>\n' +
					' * @generated\t<%= grunt.template.today("yyyy-mm-dd:hh:mm") %>\n' +
					' */\n'
		},

		// JS files and order
		jsfiles: {
			head: [
				'<%= project.scripts %>/vendor/modernizr.dev.js',
				// '<%= project.scripts %>/vendor/modernizr.min.js',
				// '<%= project.scripts %>/vendor/typekit.min.js',
				// '<%= project.scripts %>/vendor/webfont.min.js',
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
					'<%= project.scripts %>/plugins/transitionend.js',
					// '<%= project.scripts %>/plugins/disablehover.js',
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
					'<%= project.scripts %>/plugins/transitionend.js',
					// '<%= project.scripts %>/plugins/disablehover.js',
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
	});

	// Load per-task config from separate files
	grunt.loadTasks('grunt/config');

	// Register alias tasks from separate files
	grunt.loadTasks('grunt/tasks');

	// Register default task
	grunt.registerTask('default', ['develop']);

};
