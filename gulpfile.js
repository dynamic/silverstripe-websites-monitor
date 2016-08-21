var gulp = require('gulp'),
    packer = require('gulp-packer'),
    streamify = require('gulp-streamify'),
    concat = require('gulp-concat'),
    sass = require('gulp-sass');

gulp.task('js', function () {
    gulp.src([
        './javascript/src/jquery/*.js',
        './javascript/src/*.js'
    ])
        .pipe(streamify(packer({base62: true, shrink: true})))
        .pipe(concat('site.min.js'))
        .pipe(gulp.dest('./javascript/dist/'))
});

gulp.task('sass', function () {
    gulp.src('./scss/main.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('./css'));
});

gulp.task('default', ['js', 'sass']);