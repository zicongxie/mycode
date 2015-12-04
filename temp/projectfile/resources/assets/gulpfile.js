var gulp = require('gulp');
var sass = require('gulp-sass');
var cssmin = require('gulp-cssmin');
var uglify = require('gulp-uglify');
var concat = require('gulp-concat');
var chinese2unicode = require('fd-gulp-chinese2unicode');
var spritesmith = require('gulp.spritesmith');
var rename = require('gulp-rename');
var merge = require('merge-stream');
var plumber = require('gulp-plumber');
var postcss = require('gulp-postcss');
var px2rem = require('gulp-px3rem');
// css编译压缩
gulp.task('css', function(){
	return gulp.src(['sass/wap/*.scss'])
	.pipe(plumber(function(error){
		console.log(error);
		this.emit('end');
	}))
	.pipe(sass())
	.pipe(gulp.dest('css/wap/'));
});

// js压缩
gulp.task('js', function(){
	return gulp.src(['js/*.js','!**/*.min.js'])
	.pipe(plumber(function(error){
		console.log(error);
		this.emit('end');
	}))
	.pipe(uglify({output:{ascii_only: true}}))
	.pipe(rename({suffix:'.min'}))
	.pipe(gulp.dest('js'));
});

// 图片合并
gulp.task('image', function() {
	var timestamp = new Date().getTime();

	var spriteData = gulp.src('./images/sprites/*.png').pipe(spritesmith({
		imgName: 'sprite.png',
		cssName: 'sprite.scss',
		imgPath: '../../images/wap/sprite.png?' + timestamp,
		padding: 10,
		cssVarMap: function(sprite){
			sprite.name = 'ico-' + sprite.name;
		}
	}));
	var imgStream = spriteData.img.pipe(gulp.dest('../../public/statics/images/wap'));
	var cssStream = spriteData.css.pipe(gulp.dest('./sass/wap/global/common'));
	return merge(imgStream, cssStream);
});

gulp.task('pxtorem',['css'],function() {
    gulp.src('css/wap/wap.css')
        .pipe(px2rem({
		    baseDpr: 2,             // base device pixel ratio (default: 2)
		    threeVersion: false,    // whether to generate @1x, @2x and @3x version (default: false)
		    remVersion: true,       // whether to generate rem version (default: true)
		    remUnit: 64,            // rem unit value (default: 75)
		    remPrecision: 6         // rem precision (default: 6)
		}))
        .pipe(gulp.dest('../../public/statics/styles'));
});

// 监听改动文件
gulp.task('watch', function(){
	gulp.watch('sass/**/*.scss', ['pxtorem']);
	gulp.watch(['js/*.js','!js/**/*.min.js'], ['js']);
});


// 监听改动文件
gulp.task('lib', function(){
	return gulp.src(['js/lib/*.js'])
	 	  .pipe(concat('mobile.js'))
      //   .pipe(gulp.dest('dist'))
        .pipe(uglify())
        .pipe(rename('mobile.min.js'))
		  .pipe(chinese2unicode())
        .pipe(gulp.dest('js'));
});
