<?php
  function the_subnav($subnav) {
    if ($subnav === null) {
      return;
    }

    echo '<div class="subnav">';
    echo '<div class="row">';
    echo '<div class="twelve columns centered">';

    foreach ($subnav as $text => $anchor) {
      echo '<div class="subnav-item"><a href="' . $anchor . '">' . $text . '</a></div>';
    }

    echo '</div>';
    echo '</div>';
    echo '</div>';
  }

  function the_header($subnav) {
?>
  <div class="nav">
    <div class="row">
      <div class="four columns header-logo">
        <a href="/"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" /></a>
      </div>
      <div class="eight columns">
        <ul class="right" style="margin-right: 40px; z-index: 12; position: relative;">
          <li><a href="/about">About</a></li>
          <li><a href="/team">Team</a></li>
          <li><a href="/fellows">Fellows</a></li>
          <li><a href="/partners">Partners</a></li>
          <li><a href="/apply">Apply</a></li>
          <li><a href="/blog">Blog</a></li>
        </ul>
      </div>
    </div>
<div class="donate-wrapper" style="z-index:11">
        <div class="donate-ribbon">
            <a href="https://donatenow.networkforgood.org/CODE2040" class="donate-blue" style="color:white" target="_blank">Donate!</a>
        </div>
    </div>
<?php the_subnav($subnav); ?>
  </div>
 <div class="row" style="background:none;"><div class="four columns" style="height:30px"></div><div class="four columns" style="height:30px"></div><div class="four columns" style="height:30px"></div></div>

<div class="subnav_">&nbsp;</div>
<div class="full-content">
<?php
  }

