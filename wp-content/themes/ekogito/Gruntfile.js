'use strict';
module.exports = function(grunt) {

  // Load tasks
  require('load-grunt-tasks')(grunt);

  grunt.initConfig({
    image: {
      dynamic: {
        options: {
          pngquant: true,
          optipng: true,
          zopflipng: true,
          advpng: true,
          jpegRecompress: false,
          jpegoptim: true,
          mozjpeg: true,
          gifsicle: true,
          svgo: true
        },
        files: [{
          expand: true,
          cwd: '../../uploads/',
          src: ['**/**/*.{png,jpg,gif,svg}'],
          dest: '../../uploads/'
        }]
      }
    },
    // Sass Task
    sass: {
      dist: {
        options: {
	        style: 'expanded'
        },
        // Define the CSS and SASS source files
        files: {
	        'style.css': 'sass/style.scss'
      	}
      }
    },

    // Watch Task
    watch: {
      sass: {
        files: [
          'sass/**/*.scss',
          'sass/*.scss'
        ],
        options: {
          livereload: true,
        },
        tasks: ['sass']
      },
      files: {
        files: [
          '**/*.php',
          '*.php'
        ],
        options: {
          livereload: true,
        }
      }
    }
  });

  // Register tasks
  grunt.registerTask('default',['sass','image','watch']);

};
