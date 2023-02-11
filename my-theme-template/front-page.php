<?php get_header(); ?>

<style>
  .fill {
    background: #edb1d3;
  }
</style>

<main>

  <?php get_template_part('template-parts/first-view'); ?>

  <section class="pt-8">
    <div class="container" style="background: #ededed">
      <h1 class="heading">Hello World.</h1>
      <p class="typography">これはメインカラーのタイポグラフィです。これはメインカラーのタイポグラフィです。これはメインカラーのタイポグラフィです。これはメインカラーのタイポグラフィです。これはメインカラーのタイポグラフィです。これはメインカラーのタイポグラフィです。これはメインカラーのタイポグラフィです。</p>
    </div>
  </section>

  <section>
    <div class="container">
      <h1 class="heading">Utility Sample</h1>
    </div>
    <div class="mx-12 md:mx-6 sm:mx-2 xs:mx-0 text-center my-4 fill">mx-12 md:mx-6 sm:mx-2 xs:mx-0</div>
    <div class="container my-6">
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

    <div class="text-center w-10 fill">w-10</div>
    <div class="text-center w-20 fill">w-20</div>
    <div class="text-center w-40 fill">w-40</div>
    <div class="text-center w-60 fill">w-60</div>
    <div class="text-center w-full fill">w-full</div>

    <p class="block text-center mt-8">↓↓↓sm:none↓↓↓</p>
    <div class="sm:none block text-center w-full py-4 fill">display: block</div>

    <p class="block text-center mt-8">↓↓↓flex flex-wrap sm:flex-col gap-4↓↓↓</p>
    <div class="flex flex-wrap sm:flex-col gap-4">
      <div class="text-center sm:w-full w-40 py-2 fill">sm:w-full w-40</div>
      <div class="text-center sm:w-full w-40 py-2 fill">sm:w-full w-40</div>
      <div class="text-center sm:w-full w-40 py-2 fill">sm:w-full w-40</div>
      <div class="text-center sm:w-full w-40 py-2 fill">sm:w-full w-40</div>
      <div class="text-center sm:w-full w-40 py-2 fill">sm:w-full w-40</div>
      <div class="text-center sm:w-full w-40 py-2 fill">sm:w-full w-40</div>
      <div class="text-center sm:w-full w-40 py-2 fill">sm:w-full w-40</div>
    </div>
  </section>


  <section>
    <div class="container">
      <h1 class="heading">Card Component Sample</h1>
      <div class="card-list">
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
  </section>

</main>

<?php get_footer(); ?>