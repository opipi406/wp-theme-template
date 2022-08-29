<?php

function works_submenu_page() {
  add_submenu_page('works', '見出し', 'サブメニュー1', 'manage_options', 'works-first', 'add_works_submenu_page1', 1);
  add_submenu_page('works', '見出し', 'サブメニュー2', 'manage_options', 'works-second', 'add_works_submenu_page2', 2);
}

function add_works_submenu_page1() {
?>

  <div class="wrap">
    <h2>First</h2>
  </div>

<?php
}

function add_works_submenu_page2() {
?>

  <div class="wrap">
    <h2>Second</h2>
  </div>

<?php
}

add_action('admin_menu', 'works_submenu_page');