var gulp = require('gulp'),
    sass = require('gulp-sass'),
    util = require('gulp-util'),
    log = util.log,
    mincss = require('gulp-minify-css'),
    sourcemaps = require('gulp-sourcemaps');
    
gulp.task('sass',function(){
	gulp.src('./sass/**/*.scss')
	.pipe(sass().on('error',sass.logError))
	.pipe(gulp.dest('./statics/css'));
});
gulp.task('mincss',function(){
	gulp.src('./statics/css/*.css')
	.pipe(minfyCss({compatibility:'ie8'}))
	.pipe(sourcemaps.write())
	.pipe(gulp.dest('./statics/dist'));
});
gulp.task('watch:sass',function(){
	gulp.watch('./sass/**/*.scss',['sass']);
})
gulp.task('default',['watch:sass']);
