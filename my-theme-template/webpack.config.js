module.exports = {
  // mode: "development",
  entry: "./assets/js/dev/entry.js",

  output: {
    path: `${__dirname}/assets/js`,
    filename: "bundle.js"
  },

  // バンドル対象から外す
  externals: {
    jquery: 'jQuery'
  },
}