/*
 * grunt-cli
 * http://gruntjs.com/
 *
 * Copyright (c) 2012 Tyler Kellen, contributors
 * Licensed under the MIT license.
 * https://github.com/gruntjs/grunt-init/blob/master/LICENSE-MIT
 */

'use strict';

module.exports = function (grunt) {

	grunt.initConfig({
		concat: {
			css: {
				src: [
					'assets/css/jquery-ui.min.css',
					'assets/css/bootstrap.min.css',
					'assets/css/font-awesome.css',
					'assets/css/bootstrap-select.min.css',
					'assets/css/dd.css',
					'assets/css/style.min.css',
					'assets/css/responsive.min.css',
					'assets/css/php-team.css',


					'b2bchat/assets/css/style.min.css',
					'b2bchat/assets/css/custom.min.css',
					'assets/css/bootstrap-datepicker.min.css'
				],
				dest: 'assets/css/main.css'
			},

			js: {
				src: [
					'assets/js/jquery.min.js',
					'assets/js/jquery-ui.min.js',
					'assets/js/popper.min.js',
					'assets/js/bootstrap.min.js',
					'assets/js/bootstrap-select.min.js',
					'assets/js/jquery.flexslider.js',
					'assets/js/cookie.min.js',
					'assets/js/TelInput.js',
					'assets/js/jquery.dd.min.js',
					'assets/js/bootstrap-datepicker.min.js',
					'assets/js/custom.min.js'
				],
				dest: 'assets/js/main.js'
			}
		},
		uglify: {
			js: {
				src: 'assets/js/main.js',
				dest: 'assets/js/main.min.js'
			}
		},
		cssmin: {
			css: {
				src: 'assets/css/main.css',
				dest: 'assets/css/main.min.css'
			}
		}
	});

	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.registerTask('build', ['concat', 'uglify', 'cssmin']);
};
