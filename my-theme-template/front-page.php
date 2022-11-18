<?php get_header(); ?>

<main>
  <section class="intro" style="padding-top: 24px">
    <div class="container" style="background: #ededed">
      <h1 class="heading">Hello World.</h1>
      <p class="typography">これはメインカラーのタイポグラフィです。これはメインカラーのタイポグラフィです。これはメインカラーのタイポグラフィです。これはメインカラーのタイポグラフィです。これはメインカラーのタイポグラフィです。これはメインカラーのタイポグラフィです。これはメインカラーのタイポグラフィです。</p>
    </div>
  </section>

  <div class="container">
    <div class="card-list" style="padding: 40px 0">
      <?php get_template_part('template-parts/sample-card'); ?>
      <?php get_template_part('template-parts/sample-card'); ?>
      <?php get_template_part('template-parts/sample-card'); ?>
      <?php get_template_part('template-parts/sample-card'); ?>
      <?php get_template_part('template-parts/sample-card'); ?>
      <?php get_template_part('template-parts/sample-card'); ?>
      <?php get_template_part('template-parts/sample-card'); ?>
      <?php get_template_part('template-parts/sample-card'); ?>
    </div>
  </div>
</main>

<?php get_footer(); ?>