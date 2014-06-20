<?php
/*
Template Name: Team Page
*/
get_header(); ?>

<?php
  $subnav = array("Staff" => "#staff",
                  "Board" => "#board",
                  "Volunteers" => "#volunteers");
  the_header($subnav);
?>

<script type="text/javascript">
  $('.nav li:eq(1) a').addClass('selected').attr('href', null);
  $(function() {
    $(".subnav-item").first().addClass("selected-subnav");
    $(".subnav-item a").click( function(e) {
      if(!$(this).hasClass("selected-subnav")){
          $('.selected-subnav').removeClass("selected-subnav");
          $(this).addClass("selected-subnav");
          team_member = $(this).attr("href").substring(1);
          $("#team-header").text(team_member);
          $(".team-images:visible").fadeOut("fast", function () {
            $("." + team_member + "-members").fadeIn("fast");
          });
          $(".team-info:visible").fadeOut("fast", function () {
            $('.team-info' +
              $('.' + team_member + "-members .active").attr("href")).fadeIn("fast");
          });
      }
    });
    $('.team-members ul div:first-child li:first-child a').addClass('active');
    $($('.staff-members .active :first').attr('href')).show();
    $('.team-members a').on("click", function(e) {
      e.preventDefault();
      if ($(this).hasClass("active")){
        return;
      }
      var target = $(this).attr('href');
      $(this).closest('.team-images').find('a').removeClass('active');
      $('.team-info:visible').fadeOut("fast", function (){
        incoming = $('.team-info' + target);
        head_height = $('#staff').height();
        scroll_top = $('body').scrollTop();
        pane_height = incoming.height();
        var scroll_point = Math.max(Math.min(scroll_top, head_height - pane_height - 180), 0);
        incoming.css('top', scroll_point);
        incoming.fadeIn("fast");
      });
      $(this).addClass('active');
    });
  });
</script>
  <div id="staff" class="row">
  <div id="board" style="height:0"></div><div id="volunteers"></div>
    <div class="five columns team-members">
    <h2 style="text-align:center;text-transform:capitalize;" id="team-header">staff</h2>
    <ul class="staff-members team-images"><div class="row teammates"  number="0"></div></ul>
    <ul class="board-members team-images" style="display:none"><div class="row teammates" number="0"></div></ul>
    <ul class="volunteers-members team-images" style="display:none;"><div class="row teammates" number="0"></div></ul>
    </div>
      <?php
        $args=array(
          'post_type' => 'team',
          'posts_per_page' => 100,
          'taxonomy' => 'positions'
        );
$loop = new WP_Query( $args );
        $staff_i = 0;
        $board_i = 0;
        $vol_i = 0;
        while ( $loop->have_posts() ) : $loop->the_post();
          $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 600,600 ), false, '' );
          $team_member_title_array = get_post_meta($post->ID, 'team_member_title');
          $team_member_title = $team_member_title_array[0];
          $team_member_position_array = get_the_terms($post->ID, 'positions');
          if (!is_array($team_member_position_array)){
            $team_member_position_array = array();
          }
          $team_member_position = (current($team_member_position_array)->slug);
          switch ($team_member_position){
          case("staff"):
            $staff_i++;
            $li = '<li class="five columns"><a href="#member-' . $post->ID . '"><img style="height: 300px; width: 100%" src="' . $thumbnail_src[0] . '" class="framed" /><h5 style="margin:0; text-align:center; font-size:12px"><strong>' . $post->post_title  . '</strong><br>' . $team_member_title . '</h5></a></li>';
            echo '<script type="text/javascript"> $(".staff-members div:last-child").append($(\'' . $li . '\'))</script>';
            if($staff_i %2 == 0){
              echo '<script type="text/javascript"> $(".staff-members").append($("<div class=\"row teammates\" number=\"' . $staff_i/2 . '\"></div>"))</script>';
            }
            break;
          case "board":
            $board_i++;
            $li = '<li class="five columns"><a href="#member-' . $post->ID . '"><img style="height: 300px; width: 100%" src="' . $thumbnail_src[0] . '" class="framed" /><h5 style="margin:0; text-align:center; font-size:12px"><strong>' . $post->post_title  . '</strong><br>' . $team_member_title . '</h5></a></li>';
            echo '<script type="text/javascript"> $(".board-members div:last-child").append($(\'' . $li . '\'))</script>';
            if($board_i %2 == 0){
              echo '<script type="text/javascript"> $(".board-members").append($("<div class=\"row teammates\" number=\"' . $board_i/2 . '\"></div>"))</script>';
            }
            break;
          case "volunteer":
            $vol_i++;
            $li = '<li class="five columns"><a href="#member-' . $post->ID . '"><img style="height: 300px; width: 100%" src="' . $thumbnail_src[0] . '" class="framed" /><h5 style="margin:0; text-align:center; font-size:12px"><strong>' . $post->post_title  . '</strong><br>' . $team_member_title . '</h5></a></li>';
            echo '<script type="text/javascript"> $(".volunteers-members div:last-child").append($(\'' . $li . '\'))</script>';
            if($vol_i %2 == 0){
              echo '<script type="text/javascript"> $(".volunteers-members").append($("<div class=\"row teammates\" number=\"' . $vol_i/2 . '\"></div>"))</script>';
            }
            break;
          }
        endwhile;
      ?>
    <?php
      $args=array(
        'post_type' => 'team',
        'posts_per_page' => 100,
        'taxonomy' => 'positions'
      );
      $loop = new WP_Query( $args );
      while ( $loop->have_posts() ) : $loop->the_post();
        $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 600,600 ), false, '' );
        $team_member_title_array = get_post_meta($post->ID, 'team_member_title');
        $team_member_title = $team_member_title_array[0];

        echo '<div class="six columns boxed team-info" id="member-' . $post->ID . '">';
        echo '<h4>' . $post->post_title . '</h4>';
        echo '<h5>' . $team_member_title . '</h5>';
        echo '<p>' . the_content() . '</p>';
        echo '</div>';
      endwhile;
    ?>
  </div>

<?php get_footer(); ?>

