var gulp = require('gulp'),
    packer = require('gulp-packer'),
    streamify = require('gulp-streamify'),
    concat = require('gulp-concat');

gulp.task('js', function () {
    gulp.src([
        './javascript/src/jquery/*.js',
        './javascript/thirdparty/FlexSlider-2.6.2/jquery.fexslider-min.js',
        './javascript/src/*.js'
    ])
        .pipe(streamify(packer({base62: true, shrink: true})))
        .pipe(concat('site.min.js'))
        .pipe(gulp.dest('./javascript/dist/'))
});

gulp.task('default', ['js']);