<?php

function works_menu_page() {
  add_menu_page(
    'Works',
    'Works',
    'manage_options',
    'works',
    'add_works_menu_page',
    'dashicons-admin-page',
    30
  );
}

function add_works_menu_page() {
?>

  <div class="wrap">
    <h1>Works</h1>
    <?php
    // add_option('mytheme_setting', 10);
    echo get_option('mytheme_setting');
    ?>

  </div>

<?php
}

add_action('admin_menu', 'works_menu_page');
