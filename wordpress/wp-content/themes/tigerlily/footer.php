<?php
/*
Template Name: Donate
*
*/
 ?>
<div class="push"></div>
    </div>

    <!-- Footer -->
    <footer id='primary-footer'>
      <div class="row">
        <div class="five columns">
          <h4><i class="icon-twitter"></i>Recent Tweets</h4>
<hr/>
<a class="twitter-timeline" href="https://twitter.com/CODE2040" data-widget-id="319915158480756736" height="10" data-chrome="noheader nofooter">Tweets by @CODE2040</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
<p style="position:relative; left:60px; padding-top: 5px;"><iframe allowtransparency="true" frameborder="0" scrolling="no" src="http://platform.twitter.com/widgets/follow_button.1359159993.html#_=1359680715665&amp;id=twitter-widget-0&amp;lang=en&amp;screen_name=CODE2040&amp;show_count=true&amp;show_screen_name=true&amp;size=m" class="twitter-follow-button twitter-follow-button" style="width: 227px; height: 20px;" title="Twitter Follow Button" data-twttr-rendered="true"></iframe> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></p>
<div class="fb-like" data-href="https://www.facebook.com/CODE2040" data-send="false" data-layout="button_count" data-width="150" data-show-faces="false" data-font="arial" data-colorscheme="dark"></div>

        </div>

        <div class="four columns">
          <h4><i class="icon-envelope"></i>Stay In Touch</h4>
          <hr/>
          <div>
            <h5 style="color:white">Join our mailing list!</h5>
            <div class="row">
              <div class="twelve columns">
<form class="row collapse" id="mailing_list">
                  <div class="eight mobile-three columns">
                    <input id="email_field" name="email" type="text" placeholder="you@gmail.com" />
                  </div>
                  <div class="four mobile-one columns">
                    <input type="submit" name="submit" class="postfix black nice button" value='Submit'></input>
                  </div>
                </form>
</div>
              </div>
          </div>
<div class="row"><span style="
    position: relative;
    top: 12px;
    text-align: center;
    left: 45%;
    padding: 7px;
    background-color: #445C6B;
    font-family: 'Museo Sans';
    font-weight: 300;
    font-size: 15px;
     z-index: 1;
">or</span><hr style="
    margin-left: 20%;
    width: 60%;
    z-index: 0;
"></div>
            <h5 style="margin-top:0;color:white">Tell us or ask us something!</h5>
<div class="row"><div class="mail-div eight columns centered"><a class="secondary large radius mail-button button" ><i class="icon-envelope-alt"></i>Contact Us</a></div></div>
        </div>
        <div class="three columns right last-in-row">
          <h4><i class='icon-heart'></i>Help Out</h4>
          <?php $the_post = & get_post( $dummy_id = 210 ); ?>
          <hr/>
        <div class="row"><div class="twelve columns" >
        <h5 class="donate-text" style="padding-bottom:10px;color:white; margin-top:0;font-size:16px;"><?php echo  $the_post->post_content ?></h5>
<div class="row"><div class="eight columns centered" style="text-align: center;"><a class="secondary large radius button donate" href="https://donatenow.networkforgood.org/CODE2040" target="_blank">Donate</a></div></div>
</div></div>
        </div>
      </div>
    </footer>
    <footer id='copyright'>
      <div class="row">
        <span class="six columns left">
        <h4 style="margin:0"><small>Copyright © 2013, CODE2040. All rights reserved.</small></h4> </span>
      </div>
    </footer>
<div id="mail-modal" class="reveal-modal xlarge">
  <h3><strong>Contact CODE2040</strong></h3>
  <p class="lead">We're excited to hear from you! We read every email we get and will get back to you as soon as we can! <br/>Please fill out all the fields below so that we have all the information we need to follow up.</p>
  <form id="contact-form">
  <label>Your name</label>
  <input id="contact-name" type="text" class="modal-required input-text" placeholder="Name" />
   <label>Your email</label>
  <input id="contact-email" type="email" class="modal-required input-text" placeholder="Email" />

  <div><label for="customDropdown">What is your email regarding?</label>
<select id="contact-subject" style="width:200px">
  <option>Becoming a fellow</option>
  <option>Hosting or hiring a fellow</option>
  <option>Donating or sponsoring</option>
  <option>Volunteering</option>
  <option>Press/media</option>
  <option>Other</option>
</select></div>
  <hr>
  <label>Tell us more about why you're reaching out here.<br/> This way we'll know who on our team should follow up!</label>
  <textarea id="contact-message" class="modal-required" rows="6" cols="50" placeholder="Message"></textarea>
  <input type="submit" id="mail-send" class="button alert medium"></input>
  </form>
  <a class="close-reveal-modal">&#215;</a>
</div>
  <script type="text/javascript">
      valid_mail = false;
      $(".modal-required").keyup(function() {
        var filledIn = true;
        $(".modal-required").each(function() {
             var val = $(this).val();
             if(val == "" || val == 0) {
             filledIn = false;
             }
        });
        if(filledIn) {
          $("#mail-send").removeClass('alert');
          $("#mail-send").addClass('success');
          valid_mail = true;
        }
        else {
          $("#mail-send").removeClass('success');
          $("#mail-send").addClass('alert');
          valid_mail = false;
        }
      });
      //$("#mail-send").click();
      $("#contact-form").submit(function(event){
        if (request) {
          request.abort();
        }
        var $form = $(this);
        if(!valid_mail){
          alert("Please fill out all fields");
          return false;
          even.preventDefault();
        }
        $("#mail-send").prop("disabled", true);
        var request = $.ajax({
          url: "http://code2040.org/send_contact_form.php",
            type: "POST",
            data: {'sender_email': $("#contact-email").val(), 'sender_name': $("#contact-name").val(), 'subject': $('#contact-subject :selected').val(), 'message': $("#contact-message").val() }
        });
        request.done(function (response, textStatus, jqXHR){
        $("p.lead").hide();
        $('#contact-form').hide().after('<div> Thanks for reaching out to us!  We will get back to you shortly!</div>');
        });
        request.fail(function (jqXHR, textStatus, errorThrown){
          console.error(
            "The following error occured: "+
            textStatus, errorThrown
          );
        });

        request.always(function () {
          $("#email_field").prop("disabled", false);
        });

        event.preventDefault();
      });

 $("[placeholder]").textPlaceholder();
      var request;

      $("#mailing_list").submit(function(event){
        if (request) {
          request.abort();
        }
        var $form = $(this);
        $("#email_field").prop("disabled", true);
        var request = $.ajax({
            url: "http://code2040.org/join_list.php",
            type: "POST",
            data: {'email': $("#email_field").val()}
        });
        request.done(function (response, textStatus, jqXHR){
        $('#mailing_list').hide().after('<div> Thanks! We\'ll be sure to keep you up to date on all of our exciting news!</div>');
        });
        request.fail(function (jqXHR, textStatus, errorThrown){
          console.error(
            "The following error occured: "+
            textStatus, errorThrown
          );
        });

        request.always(function () {
          $("#email_field").prop("disabled", false);
        });

        event.preventDefault();
      });

      var reveal_contact =  function() {
        $("#mail-modal").reveal();
      };

      $(".mail-button").click(function() {
        $("#mail-modal").reveal();
      });
      </script>

<?php

wp_footer(); ?>
  </body>
</html>
