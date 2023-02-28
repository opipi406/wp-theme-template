<?php
define('USE_MINIFY_JS',   0);   // バンドルされたJavaScriptファイルを使用する

define('JSEXT_USE_AOS',   1);   // AOS（スクロールアニメーションプラグイン）を使用
define('JSEXT_USE_GSAP',  1);   // GSAP (アニメーションプラグイン) を使用
define('JSEXT_USE_SLICK', 0);   // slick (スライダープラグイン) を使用

define('THEME_NAME', esc_html(get_template())); // テーマ名

/*----------------------------------------------------
  管理バーの非表示
-----------------------------------------------------*/
add_filter('show_admin_bar', '__return_false');

/*----------------------------------------------------
  テーマセットアップ
-----------------------------------------------------*/
function my_theme_support()
{
  add_theme_support('post-thumbnails');   // アイキャッチ画像の有効化
  add_theme_support('menus');             // 管理画面で「外観」->「メニュー」を使えるようにする
  add_theme_support('custom-logo');

  add_theme_support('wp-block-styles');
  // add_theme_support('align-wide');
  // add_theme_support('editor-styles'); // エディターcssの適用
  // add_editor_style('editor-style.css');

  register_nav_menu('header-menu', 'ヘッダー');
  register_nav_menu('footer-menu', 'フッター');
  register_nav_menu('burger-menu', 'ハンバーガーメニュー');
}

/*----------------------------------------------------
  Register
-----------------------------------------------------*/
require get_template_directory() . '/functions/register/register_style.php'; // スタイルファイルの読み込み
require get_template_directory() . '/functions/register/register_script.php'; // スクリプトファイルの読み込み
// require get_template_directory() . '/functions/register/register_font.php'; // フォントファイルの読み込み
require get_template_directory() . '/functions/register/register_custom_post_type.php'; // カスタム投稿タイプの追加

/*----------------------------------------------------
  テーマカスタマイザーの読み込み
-----------------------------------------------------*/
require get_template_directory() . '/customizer/customize.php';
require get_template_directory() . '/customizer/style_customize.php';

/*----------------------------------------------------
  headタグに追加するコード
-----------------------------------------------------*/
require get_template_directory() . '/functions/add_head/add_head_adobefont.php'; // webフォント(Adobeフォント)の読み込み
require get_template_directory() . '/functions/add_head/add_head_custom_styles.php'; // カスタマイザーで設定したstyle情報の設定

/*----------------------------------------------------
  その他の拡張メソッド
-----------------------------------------------------*/
require get_template_directory() . '/functions/plugin/plugin_ai1wm.php';
require get_template_directory() . '/functions/plugin/plugin_cf7.php';
// require get_template_directory() . '/functions/plugin/plugin_bc_custom.php';


/**
 * 画像アセットディレクトリパス取得処理のシンタックスシュガー
 *
 * @return string imagesディレクトリのパス
 */
function get_img_dir()
{
  return get_template_directory_uri() . '/assets/images';
}

/**
 * 画像アセットディレクトリパス取得処理のシンタックスシュガー
 *
 * @return void imagesディレクトリのパスをecho
 */
function img_dir()
{
  echo get_img_dir();
}
add_action('after_setup_theme', 'my_theme_support');



/**
 * 親カテゴリ or その子カテゴリに
 * 分類されているかどうかを取得するメソッド
 *
 * @param string|array $cats
 * @param [type] $_post
 * @return bool
 */
function post_is_in_descendant_category($cats, $_post = null)
{
  foreach ((array) $cats as $cat) {
    if (!is_numeric($cat)) $cat = get_category_by_slug($cat)->term_id;
    $descendants = get_term_children((int) $cat, 'category');
    if ($descendants && in_category($descendants, $_post))
      return true;
  }
  return false;
}



/**
 * スラッグ名が日本語だったら自動的に投稿タイプ＋id付与へ変更するメソッド
 * （スラッグを設定した場合は適用しない）
 *
 * @param string $slug
 * @param integer $post_ID
 * @param mixed $post_status
 * @param string $post_type
 * @return string 自動生成されたスラッグ文字列
 */
/* <- CTRL + /
function auto_post_slug($slug, $post_ID, $post_status, $post_type)
{
  if (preg_match('/(%[0-9a-f]{2})+/', $slug)) {
    $slug = utf8_uri_encode($post_type) . '-' . $post_ID;
  }
  return $slug;
}
add_filter('wp_unique_post_slug', 'auto_post_slug', 10, 4);
// */


/**
 * /page/へのリダイレクトを無効化するメソッド
 *
 * @param string $redirect_url
 * @return void
 */
/* <- CTRL + /
function my_disable_redirect_canonical($redirect_url)
{
  if (is_archive()) {
    $subject = $redirect_url;
    $pattern = '/\/page\//';
    preg_match($pattern, $subject, $matches);

    // リクエストURLに「/page/」があれば、リダイレクトしない。
    if ($matches) {
      $redirect_url = false;
      return $redirect_url;
    }
  }
}
add_filter('redirect_canonical', 'my_disable_redirect_canonical');
// */

/**
 * /category/階層を消すメソッド
 *
 * @param string $link
 */
/* <- CTRL + /
function remcat_function($link)
{
  return str_replace("/category/", "/", $link);
}
add_filter('user_trailingslashit', 'remcat_function');
function remcat_flush_rules()
{
  global $wp_rewrite;
  $wp_rewrite->flush_rules();
}
add_action('init', 'remcat_flush_rules');
function remcat_rewrite($wp_rewrite)
{
  $new_rules = array('(.+)/page/(.+)/?' => 'index.php?category_name=' . $wp_rewrite->preg_index(1) . '&paged=' . $wp_rewrite->preg_index(2));
  $wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
}
add_filter('generate_rewrite_rules', 'remcat_rewrite');
// */
