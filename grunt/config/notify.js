module.exports = function(grunt) {

	grunt.config('notify', {
		build: {
			options: {
				title: "Task Complete (Altair)", // optional; defaults to the name in package.json, or will use project directory's name
				message: 'Build is done', // required
			},
		},
		develop: {
			options: {
				title: "Task Complete (Altair)", // optional; defaults to the name in package.json, or will use project directory's name
				message: 'Sass and Uglify finished running', // required
			},
		},
		icons: {
			options: {
				title: "Task Complete (Altair)", // optional; defaults to the name in package.json, or will use project directory's name
				message: 'Grunticon finished running', // required
			},
		},
		imageoptim: {
			options: {
				title: "Task Complete (Altair)", // optional; defaults to the name in package.json, or will use project directory's name
				message: 'Optimizing images finished running', // required
			},
		},
		release: {
			options: {
				title: "Task Complete (Altair)", // optional; defaults to the name in package.json, or will use project directory's name
				message: 'Release is ready to deploy!', // required
			},
		},
		scripts: {
			options: {
				title: "Task Complete (Altair)", // optional; defaults to the name in package.json, or will use project directory's name
				message: 'Uglify finished running', // required
			},
		},
		styles: {
			options: {
				title: "Task Complete (Altair)", // optional; defaults to the name in package.json, or will use project directory's name
				message: 'Sass finished running', // required
			},
		},
		oldie: {
			options: {
				title: "Task Complete (Altair)", // optional; defaults to the name in package.json, or will use project directory's name
				message: 'Oldie stylesheet created', // required
			},
		},
	});

};
