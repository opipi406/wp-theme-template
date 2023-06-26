const { task, watch, dest, src, series } = require('gulp')
const autoprefixer = require('gulp-autoprefixer')
const browserSync = require('browser-sync')
const purgecss = require('gulp-purgecss')

const sass = require('gulp-dart-sass')
// const sass = require('gulp-sass')(require('sass'))

/**
 * expanded     一般的なCSSのフォーマットで出力
 * compact      セレクタごとに１行にまとめて出力
 * compressed   圧縮された状態で出力
 */
const outputStyle = {
  outputStyle: 'expanded',
}

const path = {
  dist: 'assets/css',
  sass: 'assets/scss',
  js: 'assets/js',
}

// 監視下に置くファイル群の指定
const watchArray = [
  `${path.sass}/**/*.scss`,
  `${path.js}/**/*.js`,
  '**/*.html',
  '**/*.php',
]

/*----------------------------------------------------
  Watch
-----------------------------------------------------*/
task('default', () => {
  return watch(watchArray, series(['compile']))
})

task('sync', () => {
  browserSync.init({
    proxy: 'localhost:8080',
    notify: false,
    open: 'external',
  })

  watch(watchArray, series(['compile'])).on('change', browserSync.reload)
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

/*----------------------------------------------------
  Purge style.css
-----------------------------------------------------*/
task('purge', () => {
  return src(`${path.dist}/style.css`)
    .pipe(
      purgecss({
        content: ['*.php', 'template-parts/**/*.php'],
        defaultExtractor: (content) => content.match(/[\w-/:]+(?<!:)/g) || [],
      }),
    )
    .pipe(dest(path.dist))
})

/*----------------------------------------------------
  Purge utils.css
-----------------------------------------------------*/
task('purge-utils', () => {
  return src(`${path.dist}/utils.css`)
    .pipe(
      purgecss({
        content: ['*.php', 'template-parts/**/*.php'],
        defaultExtractor: (content) => content.match(/[\w-/:]+(?<!:)/g) || [],
      }),
    )
    .pipe(dest(path.dist))
})
