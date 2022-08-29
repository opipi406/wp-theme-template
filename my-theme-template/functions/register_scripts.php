<?php

/**
 * スクリプトファイルの読み込み
 */
function register_scripts() {
  $base_url = get_template_directory_uri() . '/assets/js';

  $extensions = array(
    'anime' => 'anime.min.js',
    'inview' => 'jquery.inview.min.js',
    'arctext' => 'jquery.arctext.js',
    'slick' => 'slick.min.js',
  );

  foreach ($extensions as $key => $file_name) {
    wp_enqueue_script($key, "$base_url/ext/$file_name", array('jquery'));
  }

  // 自作スクリプト
  $my_scripts = array(
    'main-js' => 'main.js',
    'burger-js' => 'burger-menu.js',
  );
  $deps = array('jquery', ...array_keys($extensions));

  // バンドルされたスクリプトファイルで読み込む
  $use_bundle = false;

  if ($use_bundle) {
    wp_enqueue_script('bundle-js', "$base_url/bundle.js", $deps, null, true);
  } else {
    foreach ($my_scripts as $key => $path) {
      wp_enqueue_script($key, "$base_url/dev/$path", $deps, null, true);
    }
  }
}

add_action('wp_enqueue_scripts', 'register_scripts');
