const gulp = require('gulp')
const sass = require("gulp-sass")(require("sass"));
const autoprefixer = require("gulp-autoprefixer");
const purgecss = require('gulp-purgecss')

// expanded     一般的なCSSのフォーマットで出力
// compact      セレクタごとに１行にまとめて出力
// compressed   圧縮された状態で出力
const outputStyle = {
  outputStyle: "compressed"
};

const utilityClassPath = "assets/css/scss/utils.scss";

/*----------------------------------------------------
  Watch
-----------------------------------------------------*/
gulp.task('default', () => {
  return gulp.watch("assets/css/scss/**/*.scss", () => {
    return gulp
      .src(["assets/css/scss/**/*.scss", "!" + utilityClassPath])
      // Sassコンパイル
      .pipe(sass(outputStyle).on("error", sass.logError))
      // ベンダープレフィックス自動付与
      .pipe(autoprefixer())
      // 出力先
      .pipe(gulp.dest('assets/css'))
  });
});


/*----------------------------------------------------
  Purge
-----------------------------------------------------*/
gulp.task('purge-utils', () => {
  return gulp
    .src('assets/css/utils.css')
    .pipe(
      purgecss({
        content: ['*.php', 'template-parts/**/*.php']
      })
    )
    .pipe(gulp.dest('assets/css'))
});

/*----------------------------------------------------
  Sass Compile Utility Class
-----------------------------------------------------*/
gulp.task('sass-utils', () => {
  return gulp
    .src(utilityClassPath)
    // Sassコンパイル
    .pipe(sass(outputStyle).on("error", sass.logError))
    // ベンダープレフィックス自動付与
    .pipe(autoprefixer())
    // 出力先
    .pipe(gulp.dest('assets/css/build'))
});