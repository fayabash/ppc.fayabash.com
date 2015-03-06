module.exports = function (grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        
        serverUrl: 'http://climatec.3xw.ch/',
        
        // CSS
        cssmin: {
            dev:{
                
                options: {
                    banner: '/* App -- minimified */'
                },
                files: {
                    '../webroot/theme/Front/css/app.min.css': [
                        'app/css/theme.css',
                        'app/css/fx.css'
                    ]
                }
            },
            vendor:{
                
                options: {
                    banner: '/* Vendor -- minimified */'
                },
                files: {
                    '../webroot/theme/Front/css/vendor.min.css': [
                        'app/css/vendor/twitter/bootstrap.min.css',
                        'app/css/vendor/fontawesome/font-awesome.min.css',
                        'app/css/vendor/3xw/fonts-path-fix.css',
                        'app/css/vendor/3xw/helpers.css',
                        'app/css/vendor/JanStevens/angular-growl.css'
                    ]
                }
            }
        },
        
        // JS
        uglify: {
            
            prod: {
                options: {
                    banner: '/* App -- prod */',
                    mangle: false
                },
                files: {
                    '../webroot/theme/Front/js/app.min.js': [
                        'app/js/modules/*.js',
                        'app/js/components/**/*.js',
                        'app/js/app.js',
                        'app/js/boostrap.js'
                    ]
                }
            },
            
            dev: {
                options: {
                    banner: '/* App -- dev */',
                    beautify: true,
                    mangle: false
                },
                files: {
                    '../webroot/theme/Front/js/app.min.js': [
                        'app/js/modules/*.js',
                        'app/js/components/**/*.js',
                        'app/js/app.js',
                        'app/js/boostrap.js'
                    ]
                }
            },
            
            vendor: {
                options: {
                    banner: '/* Vendor -- minimified */'
                },
                files: {
                    '../webroot/theme/Front/js/vendor.min.js': [
                        'app/js/vendor/crypto-js/md5.js',
                        'app/js/vendor/angular/angular-1.4.0-beta.1.min.js',
                        //'app/js/vendor/angular/angular-1.3.8.js',
                        //'app/js/vendor/imagesloaded/imagesloaded.pkgd.js',
                        //'app/js/vendor/angular/modules/angular-images-loaded.js',
                        'app/js/vendor/angular/modules/angular-resource.min.js',
                        'app/js/vendor/angular/modules/ui-bootstrap-tpls-0.12.0.min.js',
                        'app/js/vendor/angular/modules/angular-ui-router.min.js',
                        'app/js/vendor/angular/modules/angular-touch.js',
                        'app/js/vendor/angular/modules/angular-growl.js'
                    ]
                }
            }
        },
        
        htmlmin: {
            prod: {                                       // Another target
                options: {                                 // Target options
                    removeComments: true,
                    collapseWhitespace: true
                },
                files: [{                                  // Dictionary of files
                    expand: true,
                    cwd: 'app/',                             // Project root
                    src: '**/**/*.html',                        // Source
                    dest: '../webroot/theme/Front/'                            // Destination
                }]
            },
            dev: {                                  // Target
                options: {                                 // Target options
                    removeComments: false,
                    collapseWhitespace: false
                },
                files: [{                                  // Dictionary of files
                    expand: true,
                    cwd: 'app/',                             // Project root
                    src: '**/**/*.html',                        // Source
                    dest: '../webroot/theme/Front/'                            // Destination
                }]
            }
        },
        
        // WATCH AND RUN TASKS
        watch: {
            scripts: {
                files: [
                'app/js/components/**/*.js',
                'app/js/modules/*.js',
                'app/js/app.js',
                'app/js/boostrap.js'
                ],
                tasks: ['uglify:dev'],
                options: {
                    nospawn: true
                }
            },
            css: {
                files: [
                'app/css/*.css'
                ],
                tasks: ['cssmin:dev']
            },
            html: {
                files: [
                'app/**/**/*.html'
                ],
                tasks: ['htmlmin:dev']
            }
        }
    });
    
    // tasks from npm
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-htmlmin');
    grunt.loadNpmTasks('grunt-contrib-watch');
    
    // our tasks
    grunt.registerTask('default', 'watch');
    grunt.registerTask('vendor', ['cssmin:vendor', 'uglify:vendor']);
    grunt.registerTask('dev', ['cssmin:vendor', 'uglify:vendor','cssmin:dev', 'uglify:dev','htmlmin:dev']);
    grunt.registerTask('prod', ['cssmin:vendor', 'uglify:vendor','cssmin:dev', 'uglify:prod','htmlmin:prod']);
}