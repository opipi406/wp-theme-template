<?php

/**
 * All-in-One WP Migrationで特定のファイル/ディレクトリを除外してエクスポートする。
 */

add_filter(
  'ai1wm_exclude_themes_from_export',
  function ($exclude_filters) {
    array_map(
      function ($file) use (&$exclude_filters) {
        $exclude_filters[] = THEME_NAME . '/' . $file;
      },
      [
        ".DS_Store",
        "README.md",

        # Git files
        ".gitignore",
        ".git/",

        # Setting files
        ".vscode/",
        ".editorconfig",
        ".prettierrc.json",
        ".stylelintrc.js",
        "tsconfig.json",
        "gulpfile.js",
        "webpack.config.js",

        # Package manager
        "package.json",
        "package-lock.json",
        "yarn.lock",
        "composer.json",
        "node_modules/",

        # Original
        "assets/css/scss/",
        "assets/css/dist.utils/",
        "assets/js/dist",
        "assets/js/src",

        "__docs__/",
        "__docs/",
      ]
    );
    return $exclude_filters;
  }
);
