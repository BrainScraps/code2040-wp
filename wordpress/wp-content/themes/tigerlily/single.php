<?php get_header(); ?>

<?php
the_header(null);
$the_post = & get_post( $dummy_id = 127 );
?>

<div class="row">
  <div class="twelve columns">
	  	<div class="boxed">
		  <h1><?php the_title(); ?></h1>
		  <hr />
			<?php while ( have_posts() ) : the_post(); ?>

			<div class="page row">
					<p class="blog"><?php the_content(); ?></p>
			</div>

			<?php endwhile; // end of the loop. ?>
		  <?php comments_template( '', true ); ?>
		</div><!-- boxed -->
	</div><!-- twelve columns -->
</div><!-- row -->

<?php get_footer(); ?>

