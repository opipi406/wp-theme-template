<?php

function create_post_type() {

  register_post_type(
    'sample',
    array(
      'label' => 'サンプル',
      'public' => true,
      'has_archive' => true,
      'show_in_rest' => true, // RestAPIから取得可能かどうか
      'rest_base' => 'samples', // URLのベースとなる名前 (省略時はカスタム投稿タイプ名)
      'menu_position' => 5,
      // サポートする機能
      'supports' => array(
        'title',      // タイトル
        // 'editor',     // エディター
        'thumbnail',  // アイキャッチ画像
        'revisions',  // リビジョン(バックアップ)
      ),
    )
  );

  // register_taxonomy(
  //   'news-category',
  //   'news',
  //   array(
  //     'label' => 'カテゴリー',
  //     'hierarchical' => true,s
  //     'public' => true,
  //     'show_in_rest' => true,
  //   )
  // );

  // register_taxonomy(
  //   'news-tag',
  //   'news',
  //   array(
  //     'label' => 'タグ',
  //     'hierarchical' => false,
  //     'public' => true,
  //     'show_in_rest' => true,
  //     'update_count_callback' => '_update_post_term_count',
  //   )
  // );
}

add_action('init', 'create_post_type');
