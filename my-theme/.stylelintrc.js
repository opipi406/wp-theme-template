module.exports = {
  extends: ['stylelint-config-standard-scss', 'stylelint-config-recess-order'],
  ignoreFiles: ['**/node_modules/**'],
  rules: {
    'property-no-vendor-prefix': null,
    'comment-empty-line-before': 'always',
    'media-feature-range-notation': 'prefix',
    'selector-class-pattern': null,
    'no-descending-specificity': null,
  },
}
