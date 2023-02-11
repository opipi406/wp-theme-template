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

const sassPath = 'assets/scss/**/*.scss'
const outputPath = 'assets/css'

const jsPath = 'assets/js/**/*.js'
const utilityClassPath = 'assets/scss/utils.scss'

/*----------------------------------------------------
  Watch
-----------------------------------------------------*/
task('default', () => {
  browserSync.init({
    proxy: 'localhost:10090',
    notify: false,
    open: 'external',
  })

  watch([sassPath, jsPath, '**/*.php'], series(['compile'])).on(
    'change',
    browserSync.reload,
  )
})

task('nosync', () => {
  return watch([sassPath, jsPath, '**/*.php'], series(['compile']))
})

/*----------------------------------------------------
  Compile
-----------------------------------------------------*/
task('compile', () => {
  return (
    src([sassPath, '!' + utilityClassPath])
      // Sassコンパイル
      .pipe(sass(outputStyle).on('error', sass.logError))
      // ベンダープレフィックス自動付与
      .pipe(autoprefixer())
      // 出力先
      .pipe(dest(outputPath))
  )
})

/*----------------------------------------------------
  Purge style.css
-----------------------------------------------------*/
task('purge', () => {
  return src(`${outputPath}/style.css`)
    .pipe(
      purgecss({
        content: ['*.php', 'template-parts/**/*.php'],
      }),
    )
    .pipe(dest(outputPath))
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
    .pipe(dest(outputPath))
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
      .pipe(dest(outputPath))
      .on('end', () => {
        console.info('generated utility class! -> assets/css/utils.css')
      })
  )
})
