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

  // お知らせ or ブログカテゴリーの投稿ページの場合、中間のパンくずを書き換える
  if (in_category('notice') || in_category('blog')) {
    $trail->trail[$max - 2]->set_title('ブログ・お知らせ');
    $trail->trail[$max - 2]->set_url(home_url('blogs/'));
  }
  
  for ($i = 1; $i < $max - 2; $i++) {
    unset($trail->trail[$i]);
  }

  // echo '<pre>'; print_r($trail->trail); echo '</pre>';
}
add_action('bcn_after_fill', 'bc_custom');
// */
