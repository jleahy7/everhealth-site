<?php

class Header{

  private $page, $info;

  function __construct($_page, $_info){

    $this->page = $_page;
    $this->info = $_info;
    echo "<head>";
    echo "<meta charset='UTF-8'>";
    switch ($this->page) {
      case 'create-acct':
        echo "<title>Create Account</title>";
        break;
      case 'create-acct-step2':
        echo "<title>Create Account - Step 2</title>";
        break;
      case 'create-acct-step3':
        echo "<title>Create Account - Step 3</title>";
        break;
      case 'sign-in':
        echo "<title>Sign In</title>";
        break;
      case 'change-pass':
        echo "<title>Change Password</title>";
        break;
      case 'my-acct':
        echo "<title>My Account</title>";
        break;
      case 'forgot-password':
        echo "<title>Forgot Password</title>";
        break;
      case 'forgot-username':
        echo "<title>Forgot Username</title>";
        break;
      case 'change-plan':
        echo "<title>Change Plan</title>";
        break;
      case 'update-billing-info':
        echo "<title>Update Billing Information</title>";
        break;
      case 'update-profile':
        echo "<title>Update Profile Information</title>";
        break;
    }
    echo "<meta name='author' content='James Leahy'>";
    echo "<meta name='description' content='sample page for Ever Health'>";
    echo "<meta name='keyword' content='Ever Health, create account'>";
    echo "<link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet'>";
    echo "<link rel='stylesheet' type='text/css' href='css/styles.css'?>";
    echo "<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'></script>";
    echo "<script src='js/main.js'></script>";
    echo "</head>";
  }
}

?>
