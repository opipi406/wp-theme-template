<?php

/**
 * スタイルシートの読み込み
 */
function register_style()
{
  $version = wp_get_theme()->get('Version');
  $base_url = get_template_directory_uri() . '/assets/css';

  wp_enqueue_style('destyle', "$base_url/destyle.min.css", []);
  wp_enqueue_style('utils', "$base_url/utils.css", ['destyle'], $version);
  wp_enqueue_style('style', "$base_url/style.css", ['destyle'], $version);

  // animate.css
  // wp_enqueue_style('animate', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css', array('destyle'));

  // slick.css
  if (JSEXT_USE_SLICK) {
    wp_enqueue_style('slick', $base_url . '/slick.css', array('destyle'));
    wp_enqueue_style('slick-theme', $base_url . '/slick-theme.css', array('destyle', 'slick'));
  }
}

add_action('wp_enqueue_scripts', 'register_style');