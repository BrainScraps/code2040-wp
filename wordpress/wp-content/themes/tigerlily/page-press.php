<?php
/*
Template Name: Press Sources Page
 */
get_header(); ?>

<?php
the_header(null);
$the_post = & get_post( $dummy_id = 127 );
?>
<div class="row">
<div syle="padding:80px;" id="press-pane" class="twelve columns boxed"><h1><?php echo get_the_title(); ?></h1>
<hr/>
<?php
$args=array(
  'post_type' => 'press',
  'posts_per_page' => 100
);
echo '<div id="press_page" class="row"><div class="six columns"><ul style="list-style-type:none">';
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post();

$press_title = get_the_title();
$press_source_array = get_post_meta($post->ID, 'press_source');
$press_source = $press_source_array[0];
$press_author_array = get_post_meta($post->ID, 'press_author');
$press_author = $press_author_array[0];
$press_url_array = get_post_meta($post->ID, 'press_url');
$press_url = $press_url_array[0];
$press_date_array = get_post_meta($post->ID, 'press_date');
$press_date = $press_date_array[0];

echo '<li><div class="row "><div class="ten columns offset-by-one panel radius press-blurb" press-id="' . $post->ID . '" href-link="' . $press_url .'"><strong>' . $press_title . '</strong><br/>' .  ($press_author ? ($press_author . ', ') : '') . $press_source . ' ('. day_of_year($press_date) . ')</div></div></li>';


endwhile;
?>
</li>
</ul></div>
<div class="six columns"><div style="position:relative; height: 400px;" class="boxed follow-scroll"><h2 id="press-details-title"></h2><div id="press-details-content"></div><a id="press-details-url" href ='' target="_blank">Keep Reading,,,</a></div></div>
</div>
<?php
      $args=array(
        'post_type' => 'press',
        'posts_per_page' => 100
      );
      $loop = new WP_Query( $args );
      while ( $loop->have_posts() ) : $loop->the_post();

        $press_url_array = get_post_meta($post->ID, 'press_url');
        $press_url = $press_url_array[0];

        echo '<div style="display:none" class="press-details" id="press-' . $post->ID . '" href-link=' . $press_url . '>';
        echo '<div class="title">'. $post->post_title .  '</div>';
        echo '<div class="content" >';
        echo apply_filters('the_content', get_post_field('post_content', $post->ID)) . '</div>';
        echo '</div>';
      endwhile;
    ?>
</div></div>
<script>
var first_title = $(".press-details:first .title").text();
var first_content = $(".press-details:first .content").html();
var first_url = $(".press-details:first").attr("href-link");
$("#press-details-title").text(first_title);
$("#press-details-content").html(first_content);
$("#press-details-url").attr('href',first_url);
$('.press-blurb:first').addClass("selected-press");
var el = $('.follow-scroll');
var elpos_original = el.offset().top;
var lastScrollTop = 0;
var goUntil = 0
function renderBox(){
  var elpos = el.offset().top;
    var windowpos = $(window).scrollTop();
    var finaldestination = windowpos;
    if((windowpos > lastScrollTop )&& ((el.position().top + el.height() + 300) > ( $('#press-pane').position().top + $('#press-pane').height()))) {
      return;
    }
    if(windowpos<(elpos_original-90)) {
        finaldestination = elpos_original;
        el.stop().css({'top':0});
    } else {
      goUntil = finaldestination-elpos_original+100;
      if (finaldestination-elpos_original+100 >  ($('#press-pane').position().top + $('#press-pane').height() - 620 ))
          { goUntil = $('#press-pane').position().top + $('#press-pane').height() - 620; }
          el.stop().animate({'top':goUntil},500);
    }
    lastScrollTop = windowpos;
}

$(window).scroll(function() {
    //renderBox();
});

$('.press-blurb').click(function(){
  if($(this).hasClass("selected-press")){
    return;
  }
  renderBox();
  $(".selected-press").removeClass("selected-press");
  $(this).addClass("selected-press");
  var block_title = $("#press-" + $(this).attr("press-id") + " .title").text();
  var block_content = $("#press-" + $(this).attr("press-id") + " .content").html();
  var url = $(this).attr("href-link");
  $("#press-details-url").attr("href", url);
  $("#press-details-title").text(block_title);
  $("#press-details-content").html(block_content);
});

</script>
<?php get_footer(); ?>

