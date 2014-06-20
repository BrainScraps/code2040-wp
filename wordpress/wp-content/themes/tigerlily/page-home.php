<?php
/*
Template Name: Home Page
MultiEdit: Heading,Subsection
 */
get_header(); ?>

<?php
  the_header(null);
  $the_post = & get_post( $dummy_id = 2 );
?>

  <!-- First Band (Slider) -->
  <!-- The Orbit slider is initialized at the bottom of the page by calling .orbit() on #slider -->
  <div class="row slider-container" id="home-container" style="margin-bottom: -90px; display:none">
    <div class="twelve">
      <div id="slider" style="overflow:hidden">
  <script type="text/javascript">
  $(document).ready(function() {
    $('#slider').css('overflow', 'default');
    $('#home-container').css('display', 'inline');
  });
  </script>
        <?php
  $args=array(
    'post_type' => 'home_images',
    'posts_per_page' => 100
  );
  $loop = new WP_Query( $args );
  while ( $loop->have_posts() ) : $loop->the_post();
    $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 1000,400 ), false, '' );
    $alt = get_post_meta($post->ID, 'home_image_alt');
    $href = get_post_meta($post->ID, 'home_image_href');
    $btext = get_the_content($post->ID);
    echo '<a  class="slider-content" href="' . $href[0] . '" base-text="' . $btext . '" target="_blank"><img alt="' . $alt[0] . '" src="' . $thumbnail_src[0] . '" /></a>';
  endwhile;
?>
        </div>
    </div>
  </div>
  <div class="row">
    <div class="twelve columns" style="text-align: center">
      <?php $post = & get_post( $dummy_id = 2 ); multieditDisplay("Heading"); ?>
    </div>
  </div>

  <!-- Three-up Content Blocks -->
  <div class="row">
    <div class="four columns">
<iframe width="300" height="245" src="//www.youtube.com/embed/jXzNQi_cvX4" scrolling="no" border="0" frameborder="0" allowfullscreen></iframe>
    </div>

    <div class="eight columns">
      <p><?php echo $the_post->post_content ?></p>
    </div>
  </div>
  <div class="row"><div class="twelve columns home-div"><?php multieditDisplay("Subsection");?></div></div>
<!-- Put this above your </body> tag -->
  <script type="text/javascript">
     $(window).load(function() {
       $('#slider').orbit({
         pauseOnHover: true,
         startClockOnMouseOut: true,
         bullets: true,
         fluid: true,
         animation: 'fade',
         animationSpeed: 400,
         afterSlideChange: function(){replace_text = $(this.$slides[this.activeSlide]).attr("base-text"); $("div.bullet-container #box-text").text(replace_text) ;}
       });
     $(".orbit-wrapper").css('text-align', 'center').css('margin-bottom', '-60px');
     $('ul.orbit-bullets').wrap('<div class="bullet-container" />');
    $('.bullet-container').append('<span id="box-text">' + $("#slider a:first").attr('base-text') + '</span>');
     $('ul.orbit-bullets').css('bottom', '-10px');
     });

     $("[placeholder]").textPlaceholder();
  </script>


<?php get_footer(); ?>

