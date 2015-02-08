module.exports = function(grunt) {
//	require('jit-grunt')(grunt);
//	grunt.loadNpmTasks('grunt-jsvalidate');
	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-less');
	grunt.loadNpmTasks('grunt-contrib-csslint');
	
	grunt.initConfig({
		less : {
			development : {
				options : {
					compress : true,
					yuicompress : true,
					optimization : 2
				},
				files : {
					"public/css/main.css" : "public/less/main.less" // destination file // and source file
				}
			}
		},
		jshint : {
			files : [ 'Gruntfile.js', 'public/js/controllers/*.js', 'test/**/*.js' ],
			options : {
				globals : {
					jQuery : true
				}
			}
		},
		watch : {
			styles : {
				files : [ 'public/less/*.less' ], // which files to watch
				tasks : [ 'less' ],
				options : {
					nospawn : true
				}
			},
			js : {
				files: ['<%= jshint.files %>'],
				tasks : [ 'jshint' ]
			}
		}
	});

	grunt.registerTask('default', 'watch');
};