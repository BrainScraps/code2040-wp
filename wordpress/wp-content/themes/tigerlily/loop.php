<div class="eight columns">
    <?php while (have_posts()) : the_post(); ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header>
          <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
          <?php reverie_entry_meta(); ?>
        </header>
        <div class="entry-content">
      <?php if (is_archive() || is_search()) : // Only display excerpts for archives and search ?>
        <?php the_excerpt(); ?>
      <?php else : ?>
        <?php the_content('Continue reading...'); ?>
      <?php endif; ?>
        </div>
        <div class="post-divider"></div>
      </article>
    <?php endwhile; // End the loop ?>
</div>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if ( function_exists('reverie_pagination') ) { reverie_pagination(); } else if ( is_paged() ) { ?>
<nav id="post-nav">
	<div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'reverie' ) ); ?></div>
	<div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'reverie' ) ); ?></div>
</nav>
<?php } ?>

