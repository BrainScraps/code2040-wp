<?php
/*
Template Name: Partners Page
MultiEdit: Supporters,Hosts,Colleagues
*/
get_header(); ?>

<?php
  $subnav = array("Supporters" => "#supporters",
                  "Hosts" => "#hosts",
                  "Colleagues" => "#colleagues");
  the_header($subnav);
?>
<?php

  $options = array('supporters', 'hosts', 'colleagues');
  $loop_count = 0;
  foreach($options as $value) {
  $loop_count++;
  $post = & get_post( $dummy_id = 43 );
    $partner_type = substr_replace($value,"",-1);
    echo '<div class="row"><div id="' . $value . '" class="twelve columns boxed partner-panel" style="'.($loop_count == 1 ? "":"display:none;").';"><h1 style="font-weight:300">'.ucfirst($value).'</h1><hr/>';
    $med = multieditDisplay(ucfirst($value));
    if (count($med) > 0){
      echo '<hr>';
    }
    echo '<div class="row partner-row">';
  $args=array(
    'post_type' => 'partners',
    'posts_per_page' => 100,
    'tax_query' => array(
		array(
			'taxonomy' => 'involvements',
			'field' => 'slug',
			'terms' => $value
		)
	)
  );
  $i = 0;
  $loop = new WP_Query( $args );
  while ( $loop->have_posts() ) : $loop->the_post();
   if ($i != 0 && $i % 3 == 0){
      echo '</div><div class="row partner-row">';
   }
    $partners_url_array = get_post_meta($post->ID, 'partners_url');
    $partners_url = $partners_url_array[0];
    $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 200,200 ), false, '' );
    echo '<div class="four columns"><div class="container" style="height:300px;"><div class="boxed partner-box" style="height:100%; background: none; border: none; cursor: default; box-shadow:none; margin:0"><div style="cursor:pointer;display: table-cell; vertical-align: middle; display:block;" class="partner-logo" onclick=\'follow("'.$partners_url.'")\'>';
    if (is_null($thumbnail_src[0]))
      {
        echo '<h1 style="font-size:30px; margin:0;">' . $post->post_title . '</h1>';
      }
    else
      {
        echo '<img style="width:100%; width:auto;display:block; margin:auto; padding: 0 0 20px 0; max-height:100px;" src="' . $thumbnail_src[0] . '"></img>';
      }
    echo '</div><hr style="margin:0 0 15px 0; padding:0"/>';
    echo '<span>' . get_the_content() . '</span>';
    echo '</div></div></div>';
    $i++;
  endwhile;
  echo '</div></div></div>';
  unset($value);
  }
?>
  <script type="text/javascript">
  $('.nav li:eq(3) a').addClass('selected').attr('href', null);
  $(".subnav-item a").first().addClass("selected-subnav");
  $(".subnav-item a").click( function(e) {
    if(!$(this).hasClass("selected-subnav")){
      $('.selected-subnav').removeClass("selected-subnav");
      $(this).addClass("selected-subnav");
      partner_type = $(this).attr("href");
      $(".partner-panel:visible").fadeOut(200, function () {
        $(partner_type).fadeIn(200);
      });
    }
  });

  function reveal_contact() {
        $("#mail-modal").reveal();
  }

  function follow(url)
  {
    if (url !== ''){
      window.open(url, '_blank');
    }
  }
  </script>
<?php get_footer(); ?>

