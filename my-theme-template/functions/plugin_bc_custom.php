<?php
/**
 * Breadcrumb NavXTプラグイン (パンくずリスト) で
 * メインカテゴリのみを表示させるメソッド
 *
 * @param mixed $trail
 */
// /* <- CTRL + /
function bc_custom($trail)
{
  $max = count($trail->breadcrumbs);
  $trail->trail[$max - 1]->set_title('トップ');

  // 紙芝居師・紙芝居絵師のカスタム投稿ページの場合、中間のパンくずを書き換える
  if (is_post_type_archive('actor') || is_singular('actor') || is_post_type_archive('artist') || is_singular('artist')) {
    $trail->trail[$max - 2]->set_title('紙芝居師・紙芝居絵師');
    $trail->trail[$max - 2]->set_url(home_url('members/'));
  }
  // お知らせ or ブログカテゴリーの投稿ページの場合、中間のパンくずを書き換える
  if (in_category('notice') || in_category('blog')) {
    $trail->trail[$max - 2]->set_title('ブログ・お知らせ');
    $trail->trail[$max - 2]->set_url(home_url('blogs/'));
  }

  // 和文化コンテンツのカスタム投稿のページ場合、「和文化コンテンツ一覧」を表示するためにパンくずの除去をせずに関数を抜ける。
  if (is_post_type_archive('wabunka') || is_singular('wabunka')) {
    return;
  }

  for ($i = 1; $i < $max - 2; $i++) {
    unset($trail->trail[$i]);
  }

  // echo '<pre>'; print_r($trail->trail); echo '</pre>';
}
add_action('bcn_after_fill', 'bc_custom');
// */
