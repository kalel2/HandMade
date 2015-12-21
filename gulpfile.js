'use strict';
var gulp = require('gulp'),
        plugins = require('gulp-load-plugins')(),
        mains = require('main-bower-files');
var paths = {
    dist: {
        js: './web/dist/js/',
        css: './web/dist/css/',
    },
    bower: './bower_components/',
    npm: './node_modules/'
};
/**
 * VENDOR tasks
 */
gulp.task('vendor:css', function() {
    var filter = plugins.filter('*.css');
    return gulp.src(mains())
            .pipe(filter)
            .pipe(plugins.concatCss('vendor.min.css'))
            .pipe(plugins.sourcemaps.init())
            .pipe(plugins.minifyCss({keepSpecialComments: 0}))
            .pipe(plugins.sourcemaps.write('.'))
            .pipe(gulp.dest(paths.dist.css));
});
gulp.task('vendor:js', function() {
    var filter = plugins.filter('*.js');
    return gulp.src(mains())
            .pipe(filter)
            .pipe(plugins.sourcemaps.init())
            .pipe(plugins.concat('vendor.min.js'))
            .pipe(plugins.uglify())
            .pipe(plugins.sourcemaps.write('.'))
            .pipe(gulp.dest(paths.dist.js));
});

gulp.task('vendor', [
    'vendor:js',
    'vendor:css'
], function() {
    gulp.src('')
            .pipe(plugins.notify('task VENDOR is completed'));
});