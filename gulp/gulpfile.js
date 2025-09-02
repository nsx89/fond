const gulp         	= require('gulp'),
      sass 			= require('gulp-sass')(require('sass'));
      concat       	= require('gulp-concat'),
      autoprefixer 	= require('gulp-autoprefixer'),
      htmlmin      	= require('gulp-htmlmin'),
      imagemin 		= require('gulp-imagemin'),
      pngquant 		= require('imagemin-pngquant'),
      sourcemaps 		= require('gulp-sourcemaps'),
	babel 		= require('gulp-babel'),
	uglifyJs 		= require('gulp-uglifyJs');


function js() {
	return gulp.src('../private/resource/js/*.js')
	 	.pipe(babel({
			presets: ["@babel/preset-env"]
		}))
		.pipe(concat('app.js'))
		.pipe(uglifyJs())
		.pipe(gulp.dest('../private/src/js'));
};

function styles() {
	return gulp.src('../private/resource/scss/*.scss')
			.pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError))
			.pipe(autoprefixer({
				overrideBrowserslist: ['last 4 versions'],
				cascade: false
			}))
			.pipe(htmlmin({
				collapseWhitespace: true, // удаляем все переносы
				removeComments: true // удаляем все комментарии
			}))
			.pipe(gulp.dest('../private/src/css'));
};

function pjs() {
	return gulp.src('../public/resource/js/*.js')
	 	.pipe(babel({
			presets: ["@babel/preset-env"]
		}))
		.pipe(concat('app.js'))
		.pipe(uglifyJs())
		.pipe(gulp.dest('../public/src/js'));
};

function pstyles() {
	return gulp.src('../public/resource/scss/*.scss')
			.pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError))
			.pipe(autoprefixer({
				overrideBrowserslist: ['last 4 versions'],
				cascade: false
			}))
			.pipe(htmlmin({
				collapseWhitespace: true, // удаляем все переносы
				removeComments: true // удаляем все комментарии
			}))
			.pipe(gulp.dest('../public/src/css'));
};

function serve() {
	gulp.watch('../private/resource/scss/**/*.scss', styles);
	gulp.watch('../private/resource/js/**/*.js', js);
	gulp.watch('../public/resource/scss/**/*.scss', pstyles);
	gulp.watch('../public/resource/js/**/*.js', pjs);
}

gulp.task('compress', function() {
	return gulp.src('../public/src/img/*')
		.pipe(imagemin({
			interlaced: true,
			progressive: true,
			svgoPlugins: [{removeViewBox: false}],
			use: [pngquant()]
		}))
		.pipe(gulp.dest('../public/src/img'))
});

gulp.task('default', gulp.series(serve));
