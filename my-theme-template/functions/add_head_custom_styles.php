<?php

/**
 * Customizerで設定したstyle情報をwp_headに設定
 */
function add_head_custom_styles() {
?>
  <style>
    /* メイン背景 */
    .customizer__main_bgcolor {
      background-color: <?php echo get_theme_mod('main_bgcolor', '#f5f5f5') ?> !important;
    }

    /* ヘッダ背景 */
    .customizer__header_bgcolor {
      background-color: <?php echo get_theme_mod('header_bgcolor', '#ffffff') ?> !important;
    }

    /* フッタ背景 */
    .customizer__footer_bgcolor {
      background-color: <?php echo get_theme_mod('footer_bgcolor', '#ffffff') ?> !important;
    }

    /* ハンバーガーメニューポップアップ背景 */
    .customizer__nav_bgcolor {
      background-color: <?php echo get_theme_mod('burger_bgcolor', '#2b2b2b') ?> !important;
    }

    /* キャラクタースライダー説明文の縦幅 */
    .customizer__chara_description_height {
      height: <?php
              if (get_theme_mod('chara_description_height') == '') {
                echo '90';
              } else {
                echo get_theme_mod('chara_description_height', '90');
              }
              ?>px !important;
    }
  </style>

<?php
}
add_action('wp_head', 'add_head_custom_styles');
