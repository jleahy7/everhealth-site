<?php
  include "php/Info.php";

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(Info::send_contact_us($_POST['name'], $_POST['email'], $_POST['message'])){
      header('Location: contact.php?alert=contact_us_success');
    } else {
      header('Location: contact.php?alert=contact_us_failed');
    }
  }

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Locations</title>
    <link rel='shortcut icon' href='assets/favicon.ico' type='image/x-icon'/ >
    <meta name="author" content="James Leahy">
    <meta name="description" content="sample page for Ever Health">
    <meta name="keywords" content="Ever Health, create account">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/styles.css"?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js">
    </script>
    <script type="text/javascript" src="js/main.js"></script>
  </head>
  <body>
    <div id='wrapper'>
      <div id='floating-nav'>
        <?php
          if(isset($_COOKIE['account_username'])){
            echo "<a href='my-acct.php'><p class='float-nav'>" . $_COOKIE['account_username'] . "</p></a>";
            echo "<a href='sign-out.php'><p class='float-nav'>Sign Out</p></a>";
          } else {
            echo "<a href='create-acct.php'><p class='float-nav' id='create-acct-float'>Create Account</p></a>";
            echo "<a href='sign-in.php'><p class='float-nav' id='signin-float'>Sign In</p></a>";
          }
        ?>
      </div>
      <a href='index.php'>
        <div id='masthead'>
          <img id='mast-logo' src=assets/weightlifting.svg>
          <p id='mast-p'>Ever Health</p>
        </div>
      </a>
      <div id='navbar'>
        <a href="index.php"><p class='nav-link'>Home</p></a>
        <a href="locations.php"><p class='nav-link'>Locations</p></a>
        <a href="membership.php"><p class='nav-link'>Memberships</p></a>
        <a href="about-us.php"><p class='nav-link'>About Us</p></a>
        <a href="contact.php"><p class='nav-link'>Contact Us</p></a>
      </div>
      <div id='main-content'>
        <div id='main-content-br' class='break-div'></div>
        <h1 class='large-text center'>Contact Ever Health</h1>
        <p class="small-text center">Please fill out the form below and your message will be sent.</p>
        <form id='contact-form' method='POST'>
          <p class='input-title'>Name:</p>
          <input type='text' name='name' value='' class='form-input-text text-input-large'>
          <br><br>
          <p class='input-title same-line'>Email: </p><p class="hide form-error" id="email-error-p">  Please enter a valid email</p>
          <input type='email' name='email' value='' class='form-input-text text-input-large' id='contact-user-email'>
          <br><br>
          <p class='input-title'>Message:</p>
          <textarea rows="30" cols="50" name='message' class='form-input-text text-input-large tall-text-area'></textarea>
          <input class='form-input-text text-input-medium left' type='submit' name='submit' value=' Submit' id='contact-submit'>
          <input class='form-input-text text-input-medium right' type='submit' name='cancel' value=' Cancel'>
          <br><br>
        </form>
      </div>
    </div>
    <div id='footer'>
      <a href="index.php"><p class='extra-small same-line'>Home</p></a> |
      <a href="locations.php"><p class='extra-small same-line'>Locations</p></a> |
      <a href="membership.php"><p class='extra-small same-line'>Memberships</p></a> |
      <a href="about-us.php"><p class='extra-small same-line'>About Us</p></a> |
      <a href="contact.php"><p class='extra-small same-line'>Contact Us</p></a>
      <p id='footer-p'>Ever Health - 550 East Spring St. Columbus, OH 43215 - (614)287-5353 - <a href='mailto:everhealth@everhealth.com'>everhealth@everhealth.com</p>
        <ul class="share-buttons">
          <li><a href="https://www.facebook.com/sharer/sharer.php?u=&t=" title="Share on Facebook" target="_blank" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(document.URL) + '&t=' + encodeURIComponent(document.URL)); return false;"><img alt="Share on Facebook" src="assets/social/Facebook.png"></a></li>
          <li><a href="https://twitter.com/intent/tweet?source=&text=:%20" target="_blank" title="Tweet" onclick="window.open('https://twitter.com/intent/tweet?text=' + encodeURIComponent(document.title) + ':%20'  + encodeURIComponent(document.URL)); return false;"><img alt="Tweet" src="assets/social/Twitter.png"></a></li>
          <li><a href="https://plus.google.com/share?url=" target="_blank" title="Share on Google+" onclick="window.open('https://plus.google.com/share?url=' + encodeURIComponent(document.URL)); return false;"><img alt="Share on Google+" src="assets/social/Google+.png"></a></li>
          <li><a href="http://www.tumblr.com/share?v=3&u=&t=&s=" target="_blank" title="Post to Tumblr" onclick="window.open('http://www.tumblr.com/share?v=3&u=' + encodeURIComponent(document.URL) + '&t=' +  encodeURIComponent(document.title)); return false;"><img alt="Post to Tumblr" src="assets/social/Tumblr.png"></a></li>
          <li><a href="http://www.linkedin.com/shareArticle?mini=true&url=&title=&summary=&source=" target="_blank" title="Share on LinkedIn" onclick="window.open('http://www.linkedin.com/shareArticle?mini=true&url=' + encodeURIComponent(document.URL) + '&title=' +  encodeURIComponent(document.title)); return false;"><img alt="Share on LinkedIn" src="assets/social/LinkedIn.png"></a></li>
          <li><a href="mailto:everhealth@everhealth.com" title="Send email"><img alt="Send email" src="assets/social/Email.png"></a></li>
        </ul>
    </div>
  </body>
</html>
