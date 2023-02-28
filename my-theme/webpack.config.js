module.exports = {
  mode: 'development',
  entry: './assets/js/dev/_entry.js',

  output: {
    path: `${__dirname}/assets/js`,
    filename: 'script.js',
  },

  // バンドル対象から外す
  externals: {
    jquery: 'jQuery',
  },
}
