/**
 * Created by roman on 01.05.15.
 */

var gulp = require('gulp');
var concat = require('gulp-concat');
var less = require('gulp-less');
var cssmin = require('gulp-cssmin');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
var livereload = require('gulp-livereload');

var pathSite = 'modules/site/assets';
var pathManager = 'modules/manager/assets';

gulp.task('stylesSite', function() {
    gulp.src(pathSite + '/distribution/less/main.less')
        .pipe(less().on('error', function(e){console.log(e)}))
        .pipe(cssmin())
        .pipe(rename('main.min.css'))
        .pipe(gulp.dest(pathSite + '/css'))
        .pipe(livereload());
});

gulp.task('scriptsSite', function() {
    gulp.src(pathSite + '/distribution/js/*.js')
        .pipe(concat('main.min.js').on('error', function(e){console.log(e)}))
        .pipe(uglify())
        .pipe(gulp.dest(pathSite + '/js'))
        .pipe(livereload());
});

gulp.task('stylesManager', function() {
    gulp.src(pathManager + '/distribution/less/main.less')
        .pipe(less().on('error', function(e){console.log(e)}))
        .pipe(cssmin())
        .pipe(rename('main.min.css'))
        .pipe(gulp.dest(pathManager + '/css'))
        .pipe(livereload());
});

gulp.task('scriptsManager', function() {
    gulp.src(pathManager + '/distribution/js/*.js')
        .pipe(concat('main.min.js').on('error', function(e){console.log(e)}))
        .pipe(uglify())
        .pipe(gulp.dest(pathManager + '/js'))
        .pipe(livereload());
});

gulp.task('watch', function() {
    livereload.listen();
    gulp.watch(pathSite + '/distribution/less/*.less', ['stylesSite']);
    gulp.watch(pathSite + '/distribution/js/*.js', ['scriptsSite']);
    gulp.watch(pathManager + '/distribution/less/*.less', ['stylesManager']);
    gulp.watch(pathManager + '/distribution/js/*.js', ['scriptsManager']);
});

gulp.task('default', ['stylesSite', 'scriptsSite', 'stylesManager', 'scriptsManager', 'watch']);