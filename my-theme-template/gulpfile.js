const { task, watch, dest, src, series } = require('gulp')
const autoprefixer = require('gulp-autoprefixer')
const browserSync = require('browser-sync')
const purgecss = require('gulp-purgecss')

// const sass = require('gulp-sass')(require('sass'))
const sass = require('gulp-dart-sass')

// expanded     一般的なCSSのフォーマットで出力
// compact      セレクタごとに１行にまとめて出力
// compressed   圧縮された状態で出力
const outputStyle = {
  outputStyle: 'expanded',
}

const path = {
  dist: 'assets/css',
  sass: 'assets/scss',
  js: 'assets/js',
}

/*----------------------------------------------------
  Watch
-----------------------------------------------------*/
task('default', () => {
  browserSync.init({
    proxy: 'localhost:8080',
    notify: false,
    open: 'external',
  })

  watch([`${path.sass}/**/*.scss`, `${path.js}/**/*.js`, '**/*.html', '**/*.php'], series(['compile'])).on(
    'change',
    browserSync.reload,
  )
})

task('nosync', () => {
  return watch([`${path.sass}/**/*.scss`, `${path.js}/**/*.js`, '**/*.html', '**/*.php'], series(['compile']))
})

/*----------------------------------------------------
  Compile
-----------------------------------------------------*/
task('compile', () => {
  return (
    src([`${path.sass}/**/*.scss`, `!${path.sass}/utils.scss`])
      // Sassコンパイル
      .pipe(sass(outputStyle).on('error', sass.logError))
      // ベンダープレフィックス自動付与
      .pipe(autoprefixer())
      // 出力先
      .pipe(dest(path.dist))
  )
})

/*----------------------------------------------------
  Purge style.css
-----------------------------------------------------*/
task('purge', () => {
  return src(`${path.dist}/style.css`)
    .pipe(
      purgecss({
        content: ['*.php', 'template-parts/**/*.php'],
      }),
    )
    .pipe(dest(path.dist))
})

/*----------------------------------------------------
  Purge utils.css
-----------------------------------------------------*/
task('purge-utils', () => {
  return src('assets/css/utils.css')
    .pipe(
      purgecss({
        content: ['*.php', 'template-parts/**/*.php'],
      }),
    )
    .pipe(dest(path.dist))
})

/*----------------------------------------------------
  Compile utils.scss
-----------------------------------------------------*/
task('sass-utils', () => {
  return (
    src(`${path.sass}/utils.scss`)
      // Sassコンパイル
      .pipe(
        sass({
          outputStyle: 'expanded',
        }).on('error', sass.logError),
      )
      // ベンダープレフィックス自動付与
      .pipe(autoprefixer())
      // 出力先
      .pipe(dest(path.dist))
      .on('end', () => {
        console.info(`generated utility class! -> ${path.dist}/utils.css`)
      })
  )
})
