<?php get_header(); ?>

<main>

  <?php get_template_part('template-parts/first-view'); ?>

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

  <div class="container">
    <h1 class="heading">Utility Sample</h1>
  </div>
  <div class="mx-12 md:mx-6 sm:mx-2 text-center" style="background: #edb1d3">mx-12 md:mx-6 sm:mx-2</div>
  <div class="container">
    <p>
      <span class="text-6xl">text-6xl</span><br>
      <span class="text-5xl">text-5xl</span><br>
      <span class="text-4xl">text-4xl</span><br>
      <span class="text-3xl">text-3xl</span><br>
      <span class="text-2xl">text-2xl</span><br>
      <span class="text-xl">text-xl</span><br>
      <span class="text-lg">text-lg</span><br>
      <span class="text-base text-red">text-xs text-red</span><br>
      <span class="text-sm">text-sm</span><br>
      <span class="text-xs">text-xs</span><br>
    </p>
  </div>
  
</main>

<?php get_footer(); ?>