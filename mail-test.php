<?php

$mailTo = "jimmy.leahy777@gmail.com";
$subject = "suck a dick";
$message = "your a whore";

$headers = 'From: everhealth@everhealth.com' . "\r\n" .
    'Reply-To: webmaster@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

$subject = "?UTF-8?B?".base64_encode($subject)."?=";

if(mail($mailTo, $subject, $message, $headers)){
  echo "message sent successfully!";
} else {
  echo "Well your shit out of luck!";
}

 ?>
