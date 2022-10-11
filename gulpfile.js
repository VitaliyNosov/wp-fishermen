let gulp = require('gulp');
let sass = require('gulp-sass');
let browserSync = require('browser-sync').create();
let autoprefixer = require('gulp-autoprefixer');
let plumber = require('gulp-plumber');
let cssmin = require('gulp-cssmin');
let rigger = require('gulp-rigger');
let jsmin = require('gulp-uglify');
let babel = require('gulp-babel');
let concat = require('gulp-concat');
let order = require("gulp-order");

//'html',
gulp.task('online', ['sass', 'svg|png|jpg' , 'jsmin'], function () {

    browserSync.init({
        port:8080,
        open:true,
        notify:false,
        tunnel:false,
        proxy:'localhost/fishermenSite'
    });

    gulp.watch('build/css/*.+(scss|css)', ['sass']);
    gulp.watch('build/images/*.+(svg|png|jpg)', ['svg|png|jpg']);
    //gulp.watch('build/html/**/*.html', ['html']);
    gulp.watch('build/js/*.js', ['jsmin']);
});

gulp.task('sass',function () {
    gulp.src('build/css/*.+(scss|css)')
        .pipe(plumber())
        .pipe(order([
            '**/*'
        ]))
        .pipe(concat('main.min.css'))
        .pipe(sass({outputStyle:'compressed'}))
        .pipe(sass({errLogToConsole:true}))
        .pipe(autoprefixer({
            browsers:['last 50 versions'],
            cascade:false
        }))
        .pipe(cssmin())
        .pipe(gulp.dest('assets/css/'))
        .pipe(browserSync.reload({stream:true}));
});

gulp.task('jsmin', function () {
    gulp.src('build/js/*.js')
        .pipe(order([
            '**/*'
        ]))
        .pipe(concat('main.min.js'))
        /*
        .pipe(babel({
            presets: ['@babel/env']
        }))
        */
        .pipe(jsmin())
        .pipe(gulp.dest('assets/js/'))
        .pipe(browserSync.reload({stream:true}));
});

gulp.task('svg|png|jpg', function () {
   gulp.src('build/images/*')
       .pipe(gulp.dest('assets/images/'))
       .pipe(browserSync.reload({stream:true}));
});

/*
gulp.task('html',function () {
    gulp.src('build/html/pages/*.html')
        .pipe(rigger())
        .pipe(gulp.dest('dest/'))
        .pipe(browserSync.reload({stream:true}));
});
*/

gulp.task('default',['online']);