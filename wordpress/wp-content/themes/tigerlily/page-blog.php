<?php
/*
Template Name: Blog Page
MultiEdit: Issue,Organization
*/
get_header(); ?>


<?php
  the_header(null);
?>


<div class="row">


  <div class="eight columns">
			<h1 style="font-weight:300;"><?php the_title(); ?></h1><hr/>
			<?php
				$wp_query = new WP_Query(
				array(
					'post_type' => 'post'
					)
				);
			?>
				<?php while ( have_posts() ) : the_post(); ?>
				<div class="page row">
					<div class="boxed" style="margin-top:0" >
						<h3><a class="blog-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<?php the_excerpt(); ?>
						<ul class="blog-links">
							<li>Posted by <?php the_author() ?></a></li>
						</ul>
					</div>
				</div>

				<?php endwhile; // end of the loop. ?>
			    <?php wp_reset_query(); ?>
</div><!-- eight columns -->
	<?php get_sidebar(); ?>
</div><!-- row -->
  <script type='text/javascript'>
$('.nav li:eq(5) a').addClass('selected').attr('href', null);
  </script>

<?php get_footer(); ?>

