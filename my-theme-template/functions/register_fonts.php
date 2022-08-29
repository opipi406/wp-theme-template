<?php

/**
 * スタイルシートの読み込み
 */
function register_fonts() {
?>
  <style>
    @font-face {
      font-family: 'Azuki';
      src: url(<?php echo get_template_directory_uri() . '/assets/css/fonts/azuki.ttf'; ?>);
    }
  </style>
<?php
}

add_action('wp_head', 'register_fonts');
