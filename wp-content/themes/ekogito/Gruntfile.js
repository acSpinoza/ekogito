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
    uglify: {
        js_files: {
          files: {
            'dist/script.min.js': ['js/**/*.js']
          }
        }
    },
    // Sass Task
    sass: {
      dist: {
        options: {
	        style: 'compressed'
        },
        // Define the CSS and SASS source files
        files: {
	        'dist/style.min.css': 'sass/style.scss'
      	}
      }
    },

    // Watch Task
    watch: {
        js: {
            files: [
              'js/**/*.js',
              'js/*.js'
            ],
            tasks: ['uglify']
      },
      sass: {
        files: [
          'sass/**/*.scss',
          'sass/*.scss'
        ],
        tasks: ['sass']
      },
      files: {
        files: [
          '**/*.php',
          '*.php'
        ],
      }
    }
  });

  // Register tasks
  grunt.registerTask('default',['sass','image','watch', 'uglify']);

};
