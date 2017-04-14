//初始化
var gulp = require('gulp'),
    less = require('gulp-less'),
    cssmin = require('gulp-minify-css'),
    uglify = require('gulp-uglify');

//路径设定
var paths = {
    distRoot: '../../public/assets/backhome/',
    srcRoot: 'src/',
    lessRoot: 'src/less/'
};

//编译less文件
gulp.task('less', function(){
    return gulp.src(paths.lessRoot+'style.less')
        .pipe(less())
        .pipe(gulp.dest(paths.srcRoot+'/styles'));
});
//压缩css文件
gulp.task('cssmin', function(){
    return gulp.src(paths.srcRoot+'/styles/*.css')
        .pipe(cssmin())
        .pipe(gulp.dest(paths.distRoot+'/styles'));
});
//压缩js文件
gulp.task('uglify', function(){
    return gulp.src(paths.srcRoot+'/scripts/*.js')
        .pipe(uglify())
        .pipe(gulp.dest(paths.distRoot+'/scripts'));
});
//拷贝资源
gulp.task('copy', function() {
    return [gulp.src([paths.srcRoot+'api/**',paths.srcRoot+'fonts/**',paths.srcRoot+'icons/**',paths.srcRoot+'images/**',paths.srcRoot+'vendor/**'],{base:paths.srcRoot})
        .pipe(gulp.dest(paths.distRoot)),
        gulp.src('bower_components/ueditor-for-laravel/ueditor/**',{base:'bower_components/ueditor-for-laravel/'})
            .pipe(gulp.dest(paths.distRoot+'vendor/'))
    ]
});

//打包到dist目录
gulp.task('dist', ['copy','less','cssmin','uglify']);

//监控
gulp.task('watch', function() {
    //监控所有.less
    gulp.watch(paths.lessRoot+'*.less', ['less']);
});