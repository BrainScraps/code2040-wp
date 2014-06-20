
<?php
include 'sendgrid-php/SendGrid_loader.php';
$sendgrid = new SendGrid('code2040', '2040isOnline');
$mail = new SendGrid\Mail();
$mail->
  addTo('info@code2040.org')->
  setFrom('website@code2040.org')->
  setSubject('[' . $_POST['subject'] . '] from ' . $_POST['sender_name'] . ' at ' . $_POST['sender_email'])->
  setText($_POST['message'])->
  addCategory($_POST['subject']);
$sendgrid->
  web->
  send($mail);

?>
