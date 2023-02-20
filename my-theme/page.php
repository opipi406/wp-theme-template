<?php
get_header();
?>

<main style="padding: 160px 0;">
  <div class="wp-content" style="padding: 40px 0; background-color: white;">
    <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>
        <?php echo the_content(); ?>
      <?php endwhile; ?>
    <?php endif; ?>
  </div>
</main>

<?php
get_footer();
