<?php

class FloatingNav{

  private $page;

  function __construct($_page, $_info){

    $this->page = $_page;
    $this->info = $_info;

    switch ($this->page) {
      case 'create-acct':
        $this->createAcct();
        break;
      case 'sign-in':
        $this->signIn();
        break;
      case 'change-pass':
        $this->changePass();
        break;
      case 'change-profile-pic':
        $this->changeProfilePic();
        break;
      case 'my-acct':
        $this->myAcct();
        break;
      case 'forgot-password':
          $this->forgotPassword();
          break;
      case 'forgot-username':
            $this->forgotUsername();
            break;
      }

  }

  public function createAcct(){
    echo "<div id='floating-nav'>";
    echo "<a href='create-acct.php'><p class='float-nav' id='create-acct-float'>Create Account</p></a>";
    echo "<a href='sign-in.php'><p class='float-nav' id='signin-float'>Sign In</p></a>";
    echo "</div>";
  }

  public function signIn(){
    echo "<div id='floating-nav'>";
    echo "<a href='create-acct.php'><p class='float-nav' id='create-acct-float'>Create Account</p></a>";
    echo "<a href='sign-in.php'><p class='float-nav' id='signin-float'>Sign In</p></a>";
    echo "</div>";
  }

  public function changePass(){
    $username = null;
    if(isset($_COOKIE['account_username'])){
      $username = $_COOKIE['account_username'];
    }
    echo "<div id='floating-nav'>";
    echo "<a href='my-acct.php'><p class='float-nav' id='create-acct-float'>" . $username . "</p></a>";
    echo "<a href='sign-out.php'><p class='float-nav' id='create-acct-float'>Sign out</p></a>";
    echo "</div>";
  }

  public function changeProfilePic(){
    $username = null;
    if(isset($_COOKIE['account_username'])){
      $username = $_COOKIE['account_username'];
    }
    echo "<div id='floating-nav'>";
    echo "<a href='my-acct.php'><p class='float-nav' id='create-acct-float'>" . $username . "</p></a>";
    echo "<a href='sign-out.php'><p class='float-nav' id='create-acct-float'>Sign out</p></a>";
    echo "</div>";
  }

  public function myAcct(){
    $username = null;
    if(isset($_COOKIE['account_username'])){
      $username = $_COOKIE['account_username'];
    }
    echo "<div id='floating-nav'>";
    echo "<a href='my-acct.php'><p class='float-nav' id='create-acct-float'>" . $username . "</p></a>";
    echo "<a href='sign-out.php'><p class='float-nav' id='create-acct-float'>Sign out</p></a>";
    echo "</div>";
  }

  public function forgotPassword(){
    echo "<div id='floating-nav'>";
    echo "<a href='create-acct.php'><p class='float-nav' id='create-acct-float'>Create Account</p></a>";
    echo "<a href='sign-in.php'><p class='float-nav' id='signin-float'>Sign In</p></a>";
    echo "</div>";
  }

  public function forgotUsername(){
    echo "<div id='floating-nav'>";
    echo "<a href='create-acct.php'><p class='float-nav' id='create-acct-float'>Create Account</p></a>";
    echo "<a href='sign-in.php'><p class='float-nav' id='signin-float'>Sign In</p></a>";
    echo "</div>";
  }

}

?>
