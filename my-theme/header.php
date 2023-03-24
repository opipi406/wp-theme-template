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

  <div class="wrap">
    <header>

      <div class="header">
        <?php the_custom_logo(); ?>
        <nav class="header__nav">
          <?php wp_nav_menu(); ?>
        </nav>
        <button class="burger-menu">
          <div class="burger-menu__btn">
            <div class="burger-menu-line"></div>
          </div>
          <nav class="burger-menu__nav">
            <?php wp_nav_menu(); ?>
          </nav>
          <div class="burger-overlay"></div>
        </button>
      </div>

    </header>