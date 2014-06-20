<div class="eight columns">
  <?php while (have_posts()) : the_post(); ?>
        <?php the_title(); ?>
        <?php the_content(); ?>
  <?php endwhile; // End the loop ?>
</div>

