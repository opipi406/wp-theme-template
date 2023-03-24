<?php
/**
 * All-in-One WP Migrationで特定のファイル/ディレクトリを除外してエクスポートする。
 */
add_filter(
  'ai1wm_exclude_themes_from_export',
  function ($exclude_filters) {
    $exclude_filters = [
      THEME_NAME . '/.DS_Store',
      THEME_NAME . '/.gitignore',
      THEME_NAME . '/.git',
      THEME_NAME . '/node_modules',
      THEME_NAME . '/.eslintrc.json',
      THEME_NAME . '/.prettierrc.json',
      THEME_NAME . '/.stylelintrc.json',
      THEME_NAME . '/webpack.config.js',
      THEME_NAME . '/gulpfile.js',
      THEME_NAME . '/package-lock.json',
      THEME_NAME . '/package.json',
    ];
    return $exclude_filters;
  }
);
