// var elixir = require('laravel-elixir');
var gulp = require('gulp');
var sass = require('gulp-sass');
var cssmin = require('gulp-cssmin');
var uglify = require('gulp-uglify');
var concat = require('gulp-concat');
var rename = require('gulp-rename');
var postcss = require('gulp-postcss');
var plumber = require('gulp-plumber');
var px2rem = require('gulp-px3rem');
var spritesmith = require('gulp.spritesmith');
var merge = require('merge-stream');

gulp.task('px2rem', function() {
    gulp.src('./public/statics/styles/*.css')
        .pipe(px2rem())
        .pipe(gulp.dest('./dest'))
});

// js压缩
gulp.task('wapjs', function(){
	return gulp.src(['resources/assets/js/wap/*.js','!**/*.min.js'])
	.pipe(plumber(function(error){
		console.log(error);
		this.emit('end');
	}))
	.pipe(gulp.dest('public/statics/scripts/wap'))
	.pipe(uglify({output:{ascii_only: true}}))
	.pipe(rename({suffix:'.min'}))
	.pipe(gulp.dest('public/statics/scripts/wap'));
});


// 图片合并
gulp.task('image', function() {
	var timestamp = new Date().getTime();

	var spriteData = gulp.src('resources/assets/images/sprites/*.png').pipe(spritesmith({
		imgName: 'sprite.png',
		cssName: '_sprite.scss',
		imgPath: '../images/wap/sprite.png?' + timestamp,
		padding: 10,
		cssVarMap: function(sprite){
			sprite.name = 'ico-' + sprite.name;
		}
	}));
	var imgStream = spriteData.img.pipe(gulp.dest('public/statics/images/wap'));
	var cssStream = spriteData.css.pipe(gulp.dest('resources/assets/sass/global/common'));
	return merge(imgStream, cssStream);
});

// css压缩
gulp.task('wapcss', function () {
   return gulp.src('resources/assets/sass/wap/*.scss')
   .pipe(plumber(function(error){
      console.log(error);
      this.emit('end');
   }))
   .pipe(sass())
   .pipe(px2rem({
      baseDpr: 2,             // base device pixel ratio (default: 2)
      threeVersion: false,    // whether to generate @1x, @2x and @3x version (default: false)
      remVersion: true,       // whether to generate rem version (default: true)
      remUnit: 75,            // rem unit value (default: 75)
      remPrecision: 20         // rem precision (default: 6)
   }))
   .pipe(concat('wap.css'))
   .pipe(gulp.dest('public/statics/styles/'))
   .pipe(cssmin())
   .pipe(rename({suffix: '.min'}))
   .pipe(gulp.dest('public/statics/styles/'));
});

gulp.task('watch', function(){
	gulp.watch('resources/assets/**/*.scss', ['wapcss']);
	gulp.watch(['resources/assets/js/wap/**/*.js','!resources/assets/js/wap/**/*.min.js'], ['wapjs']);
});
