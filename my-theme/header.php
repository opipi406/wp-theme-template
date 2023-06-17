<!DOCTYPE html>
<html lang="ja" class="<?php echo (is_home() || is_front_page()) ? '' : 'wf-lazy' ?>">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php wp_title(); ?></title>
  <?php wp_head(); ?>
</head>

<body>
  <header>

    <div class="header">
      <?php the_custom_logo(); ?>
      <nav class="header-nav">
        <?php wp_nav_menu(); ?>
      </nav>
      <div class="burger">
        <div class="burger-btn js-burger-open"></div>
        <div class="burger-lines"><span></span></div>
        <nav class="burger-nav">
          <?php wp_nav_menu(['theme_location' => 'burger-menu']); ?>
        </nav>
        <div class="burger-overlay"></div>
      </div>
    </div>

  </header>