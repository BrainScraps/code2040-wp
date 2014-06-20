<?php
/*
Template Name: Full Width
*/
get_header();
?>

<?php the_header(null); ?>

  <div class="row">
    <div class="twelve columns">
      <div class="post-box">
        <?php get_template_part('loop', 'page'); ?>
      </div>
    </div>
  </div>

<?php get_footer(); ?>

