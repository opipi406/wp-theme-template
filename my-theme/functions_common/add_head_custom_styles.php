<?php

/**
 * Customizerで設定したstyle情報をwp_headに設定
 */
function add_head_custom_styles()
{
?>
  <style>
  </style>
<?php
}
add_action('wp_head', 'add_head_custom_styles');
