<?php

/**
 * スクリプトファイルの読み込み
 */
function register_script()
{
  $base_url = get_template_directory_uri() . '/assets/js';

  /*----------------------------------------------------
    外部スクリプト
  -----------------------------------------------------*/
  $extensions = array(
    'lazysizes' => "$base_url/ext/lazysizes.min.js",
    // 'anime' => "$base_url/ext/anime.min.js",
  );

  if (JSEXT_USE_GSAP) {
    $extensions['gsap-core'] = "//cdnjs.cloudflare.com/ajax/libs/gsap/3.11.1/gsap.min.js";
    $extensions['gsap-scroll'] = "//cdnjs.cloudflare.com/ajax/libs/gsap/3.11.1/ScrollTrigger.min.js";
  }
  if (JSEXT_USE_SLICK) {
    $extensions['slick'] = "$base_url/ext/slick.min.js";
  }

  foreach ($extensions as $key => $file_path) {
    wp_enqueue_script($key, "$file_path", array('jquery'));
  }

  /*----------------------------------------------------
    自作スクリプト
  -----------------------------------------------------*/
  $my_scripts = array(
    'main-js' => 'main.js',
    'span-wrap-js' => 'span_wrap.js',
    'burger-js' => 'burger_menu.js',
    'anim-js' => 'anim.js',
    'slider-js' => 'slider.js',
  );
  $deps = array('jquery', ...array_keys($extensions));

  if (USE_BUNDLE_JS) {
    wp_enqueue_script('bundle-js', "$base_url/bundle.js", $deps, null, true);
  } else {
    foreach ($my_scripts as $key => $path) {
      wp_enqueue_script($key, "$base_url/dev/$path", $deps, null, true);
    }
  }
}

add_action('wp_enqueue_scripts', 'register_script');
