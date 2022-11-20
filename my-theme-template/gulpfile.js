const { task, watch, dest, src, series } = require('gulp')
const sass = require('gulp-sass')(require('sass'))
const autoprefixer = require('gulp-autoprefixer')
const browserSync = require('browser-sync')
const purgecss = require('gulp-purgecss')

// expanded     一般的なCSSのフォーマットで出力
// compact      セレクタごとに１行にまとめて出力
// compressed   圧縮された状態で出力
const outputStyle = {
  outputStyle: 'compressed',
}

const utilityClassPath = 'assets/css/scss/utils.scss'

/*----------------------------------------------------
  Watch
-----------------------------------------------------*/
task('default', () => {
  browserSync.init({
    proxy: 'localhost:10090',
    notify: false,
    open: 'external',
  })

  watch(
    ['assets/css/scss/**/*.scss', 'assets/js/**/*.js', '**/*.php'],
    series(['compile']),
  ).on('change', browserSync.reload)
})

task('nosync', () => {
  return watch(
    ['assets/css/scss/**/*.scss', 'assets/js/**/*.js', '**/*.php'],
    series(['compile']),
  )
})

/*----------------------------------------------------
  Compile
-----------------------------------------------------*/
task('compile', () => {
  return (
    src(['assets/css/scss/**/*.scss', '!' + utilityClassPath])
      // Sassコンパイル
      .pipe(sass(outputStyle).on('error', sass.logError))
      // ベンダープレフィックス自動付与
      .pipe(autoprefixer())
      // 出力先
      .pipe(dest('assets/css'))
  )
})

/*----------------------------------------------------
  Purge style.css
-----------------------------------------------------*/
task('purge', () => {
  return src('assets/css/style.css')
    .pipe(
      purgecss({
        content: ['*.php', 'template-parts/**/*.php'],
      }),
    )
    .pipe(dest('assets/css'))
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
    .pipe(dest('assets/css'))
})

/*----------------------------------------------------
  Compile utils.scss
-----------------------------------------------------*/
task('sass-utils', () => {
  return (
    src(utilityClassPath)
      // Sassコンパイル
      .pipe(
        sass({
          outputStyle: 'expanded',
        }).on('error', sass.logError),
      )
      // ベンダープレフィックス自動付与
      .pipe(autoprefixer())
      // 出力先
      // .pipe(dest('assets/css/dist.utils')).on('end', () => { console.info('Generated utility class!! [assets/css/dist.utils/utils.css]'); })
      .pipe(dest('assets/css'))
      .on('end', () => {
        console.info('Generated utility class!! [assets/css/utils.css]')
      })
  )
})
