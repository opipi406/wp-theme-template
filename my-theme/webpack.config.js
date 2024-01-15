module.exports = {
  mode: 'development',
  entry: './assets/js/dist/index.js',

  output: {
    path: `${__dirname}/assets/js`,
    filename: 'script.js',
  },

  // バンドル対象から外す
  externals: {
    jquery: 'jQuery',
  },
}
