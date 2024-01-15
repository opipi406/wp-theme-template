<?php

define('EXTENSION_USES', [
  'gsap' => false,
  'aos' => false,
  'anime' => false,
  'slick' => false,
  'lazysizes' => false,
]);

/**
 * スクリプトファイルの読み込み
 */
function register_script()
{
  $version = '1';
  if (file_exists(get_theme_file_path('assets/js/script.js'))) {
    $version = filemtime(get_theme_file_path('assets/js/script.js'));
  }
  $base_url = get_template_directory_uri() . '/assets/js';

  /*----------------------------------------------------
    外部スクリプト
  -----------------------------------------------------*/
  $extensions = [];
  // GSAP
  if (EXTENSION_USES['gsap']) {
    $extensions['gsap-core'] = "//cdnjs.cloudflare.com/ajax/libs/gsap/3.11.1/gsap.min.js";
    $extensions['gsap-scroll'] = "//cdnjs.cloudflare.com/ajax/libs/gsap/3.11.1/ScrollTrigger.min.js";
  }
  // AOS.js
  if (EXTENSION_USES['aos']) {
    $extensions['aos'] = "https://unpkg.com/aos@next/dist/aos.js";
  }
  // anime.js
  if (EXTENSION_USES['anime']) {
    $extensions['anime'] = "$base_url/ext/anime.min.js";
  }
  // slick.js
  if (EXTENSION_USES['slick']) {
    $extensions['slick'] = "$base_url/ext/slick.min.js";
  }
  // lazysizes.js
  if (EXTENSION_USES['lazysizes']) {
    $extensions['lazysizes'] = "$base_url/ext/lazysizes.min.js";
  }

  foreach ($extensions as $key => $file_path) {
    wp_enqueue_script($key, "$file_path", ['jquery']);
  }

  /*----------------------------------------------------
    自作スクリプト
  -----------------------------------------------------*/
  $deps = ['jquery', ...array_keys($extensions)];

  wp_enqueue_script('script', "$base_url/script.js", $deps, $version, true);
}

/**
 * スタイルシートの読み込み
 */
function register_style()
{
  $version = '1';
  if (file_exists(get_theme_file_path('assets/css/style.css'))) {
    $version = filemtime(get_theme_file_path('assets/css/style.css'));
  }
  $base_url = get_template_directory_uri() . '/assets/css';

  /*----------------------------------------------------
    リセットCSS
  -----------------------------------------------------*/
  wp_enqueue_style('destyle', $base_url . '/destyle.min.css', []);
  $deps[] = 'destyle';

  /*----------------------------------------------------
    外部CSS
  -----------------------------------------------------*/
  $deps = [];

  // animate.css
  // wp_enqueue_style('animate', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css', $deps);
  // AOS.css
  if (EXTENSION_USES['aos']) {
    wp_enqueue_style('aos', "$base_url/aos.css", $deps);
  }
  // slick.css
  if (EXTENSION_USES['slick']) {
    wp_enqueue_style('slick', "$base_url/slick.css", $deps);
    wp_enqueue_style('slick-theme', "$base_url/slick-theme.css", ['destyle', 'slick']);
    $deps[] = 'slick';
    $deps[] = 'slick-theme';
  }

  wp_enqueue_style('utils', "$base_url/utils.css", $deps, $version);
  wp_enqueue_style('style', "$base_url/style.css", $deps, $version);
}

add_action('wp_enqueue_scripts', 'register_script');
add_action('wp_enqueue_scripts', 'register_style');
