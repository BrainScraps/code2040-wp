<?php
/*
Template Name: Apply Page
MultiEdit: ApplyTitle,Companies,CompaniesTitle,Recommend,RecommendTitle,OverviewTitle,Overview
*/
get_header(); ?>

<?php
  $subnav = array("Overview" => "#overview",
                  "Students" => "#students",
                  "Companies" => "#companies",
                  "Recommend" => "#recommend");
  the_header($subnav);

  $the_post = & get_post( $dummy_id = 101 );
?>

<div id="overview" class="page row" style="padding-top:40px;">
<div class="twelve columns boxed">
<?php multieditDisplay("OverviewTitle")?>
    <?php multieditDisplay("Overview"); ?>
  </div>
</div>
<hr>
<div id="students" class="page row">
<div class="twelve columns boxed">
<?php multieditDisplay("ApplyTitle")?>
    <?php echo $the_post->post_content ?>
  </div>
</div>
<hr>
<div id="companies" class="page row">
  <div class="twelve columns boxed">
    <?php multieditDisplay("CompaniesTitle"); ?>
    <?php multieditDisplay("Companies"); ?>
  </div>
</div>
<hr>
<div id ="recommend" class="page row">
  <div class="twelve columns boxed">
    <?php multieditDisplay("RecommendTitle"); ?>
    <?php multieditDisplay("Recommend"); ?>
  </div>
</div>
</div>
  <script type='text/javascript'>
$('.nav li:eq(4) a').addClass('selected').attr('href', null);
  </script>
<?php get_footer(); ?>

