<?php

/**
 * スクリプトファイルの読み込み
 */
function register_script()
{
  $version = wp_get_theme()->get('Version');
  $base_url = get_template_directory_uri() . '/assets/js';

  /*----------------------------------------------------
    外部スクリプト
  -----------------------------------------------------*/
  $extensions = [
    'lazysizes' => "$base_url/ext/lazysizes.min.js",
    // 'anime' => "$base_url/ext/anime.min.js",
  ];

  // AOS.js
  if (JSEXT_USE_AOS) {
    $extensions['aos'] = "$base_url/ext/aos.js";
  }
  // GSAP
  if (JSEXT_USE_GSAP) {
    $extensions['gsap-core'] = "//cdnjs.cloudflare.com/ajax/libs/gsap/3.11.1/gsap.min.js";
    $extensions['gsap-scroll'] = "//cdnjs.cloudflare.com/ajax/libs/gsap/3.11.1/ScrollTrigger.min.js";
  }
  // slick.js
  if (JSEXT_USE_SLICK) {
    $extensions['slick'] = "$base_url/ext/slick.min.js";
  }

  foreach ($extensions as $key => $file_path) {
    wp_enqueue_script($key, "$file_path", ['jquery']);
  }

  /*----------------------------------------------------
    自作スクリプト
  -----------------------------------------------------*/
  $my_scripts = [
    'main' => 'main.js',
    'span-wrap' => 'span_wrap.js',
    'burger' => 'burger_menu.js',
    'anim' => 'anim.js',
    'slider' => 'slider.js',
  ];
  $deps = ['jquery', ...array_keys($extensions)];

  if (USE_MINIFY_JS) {
    wp_enqueue_script('script', "$base_url/script.js", $deps, $version, true);
  } else {
    foreach ($my_scripts as $key => $path) {
      wp_enqueue_script($key, "$base_url/dev/$path", $deps, $version, true);
    }
  }
}

add_action('wp_enqueue_scripts', 'register_script');
