'use strict';

var gulp = require('gulp'),
	pkg = require('./package.json'),
	del = require('del'),
	eslint = require('gulp-eslint'),
	concat = require('gulp-concat'),
	copy = require('gulp-copy'),
	babel = require('gulp-babel'),
	uglify = require('gulp-uglify'),
	notify = require('gulp-notify'),
	plumber = require('gulp-plumber'),
	sass = require('gulp-sass'),
	cleanCSS = require('gulp-clean-css'),
	cached = require('gulp-cached'),
	scssLint = require('gulp-scss-lint'),
	imagemin = require('gulp-imagemin'),
	gUtil = require('gulp-util'),
	imageminPngquant = require('imagemin-pngquant');;

// helper functions
function onError(err) {
	gUtil.log('\n', gUtil.colors.bold(gUtil.colors.red('Error ocurred: ') + err.message + ' @ ' + err.fileName + ':' + err.lineNumber), '\n');
	gUtil.beep();
	this.emit('end');
}

function getArgument(key) {
	return gUtil.env[key] ? gUtil.env[key] : null;
}

gulp.task('default', ['clean'], function() {
	gulp.start('js:eslint');
	gulp.start('js:build');
	gulp.start('sass:build');
	gulp.start('sass:lint');

	gulp.watch(pkg.js.watch, ['js:eslint', 'js:build']);
	gulp.watch(pkg.sass.watch, ['sass:build', 'sass:lint']);
});

gulp.task('deploy', function() {
    gulp.start('js:build');
    gulp.start('sass:build');
});

// clean folders
gulp.task('clean', function() {
	pkg.clean.forEach(function(path) {
		return del.sync(path, {
			'force': true
		});
	});
});

// js:build
gulp.task('js:build', function() {
	pkg.js.files.forEach(function(o) {
		return gulp.src(o.src)
			.pipe(plumber({'errorHandler': onError}))
			.pipe(concat(o.file))
			.pipe(uglify())
			.pipe(gulp.dest(o.dest))
			.pipe(notify({
				'message': 'JS build complete',
				'onLast': true // otherwise the notify will be fired for each file in the pipe
			}));
	});
});

// js:eslint
gulp.task('js:eslint', function() {
	return gulp.src(pkg.js.hint.src)
		.pipe(plumber({
			'errorHandler': onError
		}))
		.pipe(eslint())
		.pipe(eslint.format())
		.pipe(eslint.failAfterError())
		.pipe(notify({
			'message': 'JS eslint complete',
			'onLast': true // otherwise the notify will be fired for each file in the pipe
		}));
});

// sass:build
gulp.task('sass:build', function() {
	pkg.sass.files.forEach(function(o) {
		return gulp.src(o.src)
			.pipe(sass())
			.pipe(cleanCSS({compatibility: 'ie9'}))
			.pipe(gulp.dest(o.dest))
			.pipe(notify({
				'message': 'SASS build complete',
				'onLast': true // otherwise the notify will be fired for each file in the pipe
			}));
	});
});

// sass:lint
gulp.task('sass:lint', function() {
	return gulp.src(pkg.sass.watch)
		.pipe(cached('scssLint'))
		.pipe(scssLint())
		.pipe(notify({
			'message': 'SASS lint complete',
			'onLast': true // otherwise the notify will be fired for each file in the pipe
		}));
});
