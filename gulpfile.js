var gulp = require('gulp'),
rename = require('gulp-rename'),
reload = require('gulp-livereload'),
connect = require('gulp-connect'),
jade = require('gulp-jade'),
sass = require('gulp-sass'),
plumber = require('gulp-plumber'),
autoprefixer = require('gulp-autoprefixer')
plumber = require('gulp-plumber');

gulp.task('connect', function () {
	connect.server({
		root: '',
		livereload: true
	})
})


gulp.task('html-transformer',function () {
	return gulp.src('./jade/*.jade')
		.pipe(plumber())
		.pipe(jade({
			pretty: true
		}))
		.pipe(plumber())
		.pipe(gulp.dest(''))
		.pipe(connect.reload())
})

gulp.task('sass', function () {
	return gulp.src('./sass/main.sass')
		.pipe(sass.sync().on('error', sass.logError))
		.pipe(sass({noCache: true}))
	    .pipe(autoprefixer())
	    .pipe(gulp.dest('./dist/css/'))
	    .pipe(rename('main.min.css'))
	    .pipe(gulp.dest('./dist/css/'))
	    .pipe(connect.reload());
})


gulp.task('watch', function(){
	gulp.watch('./sass/*.sass',['sass'])
	gulp.watch('./sass/blocks/*.sass',['sass'])
	gulp.watch('./jade/*.jade',['html-transformer'])
	gulp.watch('./jade/blocks/*.jade',['html-transformer'])
});

gulp.task('default', ['watch', 'connect'])
