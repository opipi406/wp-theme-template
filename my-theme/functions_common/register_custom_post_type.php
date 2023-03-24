<?php

function register_custom_post_type()
{
  /*----------------------------------------------------
    カスタム投稿タイプ
  -----------------------------------------------------*/
  register_post_type(
    'work',
    [
      'label' => '実績',
      'public' => true,
      'has_archive' => true,
      'show_in_rest' => true, // RestAPIから取得可能かどうか
      'menu_position' => 5,
      // サポートする機能
      'supports' => [
        'title',      // タイトル
        'editor',     // エディター
        'thumbnail',  // アイキャッチ画像
        'revisions',  // リビジョン(バックアップ)
      ],
      // 'rewrite' => ['slug' => 'subdir/works', 'with_front' => true],
    ]
  );

  // タグ
  register_taxonomy(
    'member-tag',
    ['actor', 'artist'],
    [
      'label' => '紙芝居師・紙芝居絵師タグ',
      'hierarchical' => false,
      'public' => true,
      'show_in_rest' => true,
      'update_count_callback' => '_update_post_term_count',
    ]
  );
}

add_action('init', 'register_custom_post_type');
