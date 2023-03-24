<?php

/**
 * 追加のフォント読み込み
 */
function add_head_extrafont() {
?>
  <style>
    @font-face {
      font-family: 'Azuki';
      src: url(<?php echo get_template_directory_uri() . '/assets/css/fonts/azuki.ttf'; ?>);
    }
  </style>
<?php
}

add_action('wp_head', 'add_head_extrafont');
