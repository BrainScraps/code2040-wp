<?php
/*
Template Name: FAQ Page
 */
get_header(); ?>

<?php
the_header(null);
?>
<div class="row">
<div syle="padding:80px;" id="faq-pane" class="twelve columns boxed"><h1><?php echo get_the_title(); ?></h1>
<hr/>
<?php
$args=array(
  'post_type' => 'faq',
  'posts_per_page' => 100
);
echo '<div id="faq_page" class="row"><div class="twelve columns"><ul class="accordion">';

$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post();

$faq_q = get_the_content($post->ID);
echo '<li><div class="title"><strong>' . $faq_q . '</strong></div>';
echo '<div class="content">' . get_secondary_content( 'Answer' , $post->ID ) . '</div></li>';


endwhile;
?>
</ul></div>
</div></div>
<script>
$('.accordion li:first').addClass('active');
</script><?php get_footer(); ?>

