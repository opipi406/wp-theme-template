<?php

/**
 * テーマセットアップ
 */
function unico_theme_support() {
  // add_theme_support('post-thumbnails');   // アイキャッチ画像の有効化
  add_theme_support('menus');             // 管理画面で「外観」->「メニュー」を使えるようにする
  // add_theme_support('wp-block-styles');   // テーマをブロックエディタに対応させる
  add_theme_support('custom-logo');
}

/**
 * 画像ディレクトリを取得する関数
 */
function get_image_directory_uri() {
  return get_template_directory_uri() . '/assets/images';
}

add_action('after_setup_theme', 'unico_theme_support');

/** 
 * 汎用的な関数群
 */
require get_template_directory() . '/functions/register_styles.php'; // スタイルファイルの読み込み
require get_template_directory() . '/functions/register_scripts.php'; // スクリプトファイルの読み込み
require get_template_directory() . '/functions/register_fonts.php'; // フォントファイルの読み込み
require get_template_directory() . '/functions/register_custom_post_type.php'; // カスタム投稿タイプの追加

require get_template_directory() . '/admin-menu/works-menu.php';
require get_template_directory() . '/admin-menu/works-submenu.php';

/**
 * テーマカスタマイザーの読み込み
 */
require get_template_directory() . '/customizer/customize.php';
require get_template_directory() . '/customizer/style_customize.php';

/**
 * wp_head
 */
// require get_template_directory() . '/functions/add_head_webfonts.php'; // webフォントの読み込み
require get_template_directory() . '/functions/add_head_custom_styles.php'; // カスタマイザーで設定したstyle情報の設定