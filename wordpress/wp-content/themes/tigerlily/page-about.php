<?php
/*
Template Name: About Page
MultiEdit: Issue,Organization
*/
get_header(); ?>

<?php
$subnav = array("The Issue" => "#issue",
  "The Organization" => "#organization",
  "The Press" => "#press");
the_header($subnav);

$the_post = & get_post( $dummy_id = 7 );
?>
<div class="row first" id="issue">
  <div class="twelve columns boxed">
    <h1 style="font-weight: 300;">The Issue</h1><hr/>
    <p><?php multieditDisplay("Issue"); ?></p>
    <div class="content-footer"><a class="content-footer-link middle" href="/blog"><i class=" icon-share-alt" style="padding-right: 15px;"></i>Check out our blog</a></div>
  </div>
</div>
<div class="row" id="organization">
  <div class="twelve columns boxed">
    <h1 style="font-weight: 300;">What We're Doing</h1><hr/>
    <p><?php multieditDisplay("Organization"); ?></p>
    <div class="content-footer"><a class="content-footer-link middle" href="/fellows"><i class=" icon-share-alt" style="padding-right: 15px;"></i>Meet our fellows</a></div>
  </div>
</div>
<div class="row" id="press">
  <div class="twelve columns boxed">
    <h1 style="font-weight: 300;">Our Reception</h1><hr/>
  <div id="press" class="eleven columns centered">
<?php
$args=array(
  'post_type' => 'press',
  'posts_per_page' => 3
);
$loop = new WP_Query( $args );
$i=0;
while ( $loop->have_posts() ) : $loop->the_post();

$press_blurb = strip_tags(get_the_content());
$press_date_array = get_post_meta($post->ID, 'press_date');
$press_date = $press_date_array[0];
$press_source_array = get_post_meta($post->ID, 'press_source');
$press_source = $press_source_array[0];
$press_author_array = get_post_meta($post->ID, 'press_author');
$press_author = $press_author_array[0];
$press_url_array = get_post_meta($post->ID, 'press_url');
$press_url = $press_url_array[0];
$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 600,600 ), false, '' );

echo '<div class="row press-box" >';
echo ($i !== 1 ? '<div class="three columns press-logo-container" onclick=\'follow("' . $press_url . '")\'><div class="row"><div class="twelve columns" style="padding-top:25px"><img src="' . $thumbnail_src[0] . '"/></div></div></div>' : '');
echo '<div id="pressquote_1"></div>';
echo '<div class="press-quote-container nine columns"><blockquote>';
echo the_secondary_content('Blurb for About Page', $post->ID );
echo ' </blockquote>';
echo '<div class="attribution row" style="top:-10px; position:relative;"><cite class="eleven columns offset-by-one">' . $post->post_title . ', ' . $press_source . '</cite></div></div>';
echo ($i == 1 ? '<div class="three columns press-logo-container2" onclick=\'follow("' . $press_url . '")\' > <div class="row"><div class="twelve columns" style="padding-top:25px"><img src="' . $thumbnail_src[0] . '"/></div></div></div>' : '');
echo '</div>';
$i++;
endwhile;
?>
</div>
<div class="content-footer"><a class="content-footer-link middle" href="<?php echo get_permalink( 127 ); ?>"><i class=" icon-share-alt" style="padding-right: 15px;"></i>Go to our press page</a></div>
</div></div></div></div></div>

  </div>
</div>
<script>
$('.nav li:eq(0) a').addClass('selected').attr('href', null);
function follow(url)
{
  window.open(url, '_blank');
}
</script>
<?php get_footer(); ?>

