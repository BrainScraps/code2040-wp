<?php
/*
Template Name: Fellows Page
MultiEdit: 2012Overview,2013Overview
 */
get_header(); ?>

<?php
  $subnav = array("2013" => "#2013a",
                  "2012" => "#2012a");
  the_header($subnav);
?>
<div id="2012a"></div>
<div id="2013a"></div>
<div class="row">
<div class="year-container boxed" >
<h1 id="year-heading" style="font-weight:300; padding-left:20px;">Our 2013  Fellows</h1>
  <div id="class2012" name="2012" class="fellow-year row">
  <div class="ten columns offset-by-one" style="padding: 0 0 20px 0"><?php multieditDisplay("2012Overview"); ?></div>
<?php
  $args=array(
    'post_type' => 'fellows',
    'posts_per_page' => 100,
    'taxonomy' => 'classes',
    'term' => '2012'
  );
  $index = 0;
  $loop = new WP_Query( $args );
  echo '<div class="scroll-container twelve columns">';
  echo '<span class="scroll-arrow left-scroll"><i class="icon-chevron-left left-arrow-icon"></i></span>';
  echo '<span class="scroll-arrow right-scroll"><i class="icon-chevron-right right-arrow-icon"></i></span>';
  echo '<div id="2012scroll" class="fellow-scroll"><ul>';
  $bios2012 = "";
  while ( $loop->have_posts() ) : $loop->the_post();
    $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 600,600 ), false, '' );
    $terms = get_the_terms($post->ID, 'classes');
    $term = array_shift($terms);
    $fellow_major_array = get_post_meta($post->ID, 'fellow_major');
    $fellow_major = $fellow_major_array[0];
    $fellow_university_array = get_post_meta($post->ID, 'fellow_university');
    $fellow_university = $fellow_university_array[0];
    echo '<li class="fellow-li bw-enabled' . ($index == 0 ? " bw-selected" : "") . '" year="2012" number="' . $index . '"><img class="framed" src="' . $thumbnail_src[0] . '" /><span style="">' . array_shift(explode(" ", $post->post_title, 2)) . '</span></li>';
    //echo '<li class="bw_e"><a href="#member-' . $post->ID . '"><img style="height: 300px; width: 100%" src="' . $thumbnail_src[0] . '" class="framed" /></a></li>';
    echo '<div style="' . ($index == 0 ?  "" : "display:none;") . '" id="fellow-2012-' . $index . '" year="2012" class="fellow-bio-2012">';
    echo '<h1 style="font-weight:300; font-size: 32px; margin-bottom:0">' . $post->post_title . '</h1>';
  echo '<h3 style="padding-bottom:0; border:none; font-size: 28px;font-weight:300; margin: 3px 0">' . $fellow_major . ", " . $fellow_university . '</h3>';
      if ( class_exists( 'kdMultipleFeaturedImages' ) ) {
    echo '<div style="width:150px;padding:5px 0">';
      kd_mfi_the_featured_image( 'company_logo', 'fellows' );
    echo '</div>';
    }
    echo '<p>' . the_content() . '</p>';

    echo '</div>';
    $index+=1;
  endwhile;
    echo '</ul></div>';
    echo '</div>';
    echo '<div id="bios2012" class="twelve columns"></div>';
?>
</div>

<div id="class2013" name="2013 " class="fellow-year row">
  <?php $post = & get_post( $dummy_id = 24 ); ?>
  <div class="ten columns offset-by-one" style="padding: 0 0 20px 0"><?php multieditDisplay("2013Overview"); ?></div>
<?php
  $args=array(
    'post_type' => 'fellows',
    'posts_per_page' => 100,
    'taxonomy' => 'classes',
    'term' => '2013'
  );
  $index = 0;
  $loop = new WP_Query( $args );
  echo '<div class="scroll-container twelve columns">';
  echo '<span class="scroll-arrow left-scroll"><i class="icon-chevron-left left-arrow-icon"></i></span>';
  echo '<span class="scroll-arrow right-scroll"><i class="icon-chevron-right right-arrow-icon"></i></span>';
  echo '<div id="2013scroll" class="twelve columns fellow-scroll"><ul>';
  $bios2013 = "";
  while ( $loop->have_posts() ) : $loop->the_post();
    $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 600,600 ), false, '' );
    $terms = get_the_terms($post->ID, 'classes');
    $term = array_shift($terms);
    $fellow_major_array = get_post_meta($post->ID, 'fellow_major');
    $fellow_major = $fellow_major_array[0];
    $fellow_university_array = get_post_meta($post->ID, 'fellow_university');
    $fellow_university = $fellow_university_array[0];
    echo '<li class="fellow-li bw-enabled' . ($index == 0 ? " bw-selected" : "") . '" year="2013" number="' . $index . '"><img class="framed" src="' . $thumbnail_src[0] . '" /></li>';
    //echo '<li class="bw_e"><a href="#member-' . $post->ID . '"><img style="height: 300px; width: 100%" src="' . $thumbnail_src[0] . '" class="framed" /></a></li>';
    echo '<div id="fellow-2013-' . $index . '" ' . ($index == 0 ?  "" : "style='display:none'") . '" year="2013" class="fellow-bio-2013">';
    echo '<h1 style="font-weight:400">' . $post->post_title . '</h1>';
  echo '<h3 style="padding-bottom:0; border:none; font-size: 32px;font-weight:200">' . $fellow_university . '</h3>';
      if ( class_exists( 'kdMultipleFeaturedImages' ) ) {
    echo '<div style="width:150px;padding-bottom:15px">';
      kd_mfi_the_featured_image( 'company_logo', 'fellows' );
    echo '</div>';
    }
    echo '<p>' . the_content() . '</p>';

    echo '</div>';
    $index+=1;
  endwhile;
    echo '</ul></div>';
    echo '</div>';
    echo '<div id="bios2013" class="twelve columns"></div>';
?>
  </div>
</div></div>
    <script type='text/javascript'>
    $('.nav li:eq(2) a').addClass('selected').attr('href', null);
    $("#class2012 .left-scroll").click(function (){
      var scroller = $("#2012scroll");
      var scroll_position = $(scroller).scrollLeft();
      $(scroller).stop().animate({scrollLeft:Math.max((scroll_position - 240) , 0)});
    });
    $("#class2012 .right-scroll").click(function(){
      var scroller = $("#2012scroll");
      var scroll_position = $(scroller).scrollLeft();
      $(scroller).stop().animate({scrollLeft:scroll_position + 240});
    });
    $("#class2013 .left-scroll").click(function (){
      var scroller = $("#2013scroll");
      var scroll_position = $(scroller).scrollLeft();
      $(scroller).stop().animate({scrollLeft:Math.max((scroll_position - 240) , 0)});
    });
    $("#class2013 .right-scroll").click(function(){
      var scroller = $("#2013scroll");
      var scroll_position = $(scroller).scrollLeft();
      $(scroller).stop().animate({scrollLeft:scroll_position + 240});
    });
    $(".subnav-item").first().addClass("selected-subnav");
    $(".fellow-bio-2012").each(function(){
      $("#bios2012").append(this);
    });
    $(".fellow-bio-2013").each(function(){
      $("#bios2013").append(this);
    });
    $(".subnav-item a").click( function(e) {
      if($(this).attr('href') == "#2012a"){
        if ($("#class2012").is(":hidden")) {
          $('.selected-subnav').removeClass("selected-subnav");
          $(this).addClass("selected-subnav");
          $("#year-heading").text("Our 2012 Fellows");
          $("#bios2013").fadeOut("fast", function(){
          $("#bios2012").fadeIn("fast");});
          $("#class2013").fadeOut("fast", function(){
          $("#class2012").fadeIn("fast");});
        }
      }
      if($(this).attr('href') == "#2013a") {
        if ($("#class2013").is(":hidden")) {
           $(".selected-subnav").removeClass("selected-subnav");
          $(this).addClass("selected-subnav");
          $("#year-heading").text("Our 2013 Fellows");
          $("#bios2012").fadeOut("fast", function() {
          $("#bios2013").fadeIn("fast");});
          $("#class2012").fadeOut('fast', function() {
          $("#class2013").fadeIn('fast');});
        }}
    });
  $(".fellow-li").click( function(e) {
    if($(this).hasClass("bw-selected")){
      return true;
    }
    year = $(this).attr("year");
    number = $(this).attr("number");
    $("#fellow-"+year+"-"+$("#"+year+"scroll .bw-selected").attr("number")).fadeOut("fast", function(){
      $("#fellow-"+ year + "-" + number).fadeIn("fast");
    });
    $("#"+year+"scroll .bw-selected").removeClass("bw-selected");
    $(this).addClass("bw-selected");
  });
  </script>

<?php get_footer(); ?>

