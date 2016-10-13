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

  }

  public function changeProfilePic(){

  }

  public function myAcct(){
    echo "<div id='floating-nav'>";
    echo "<a href='sign-out.php'><p class='float-nav' id='create-acct-float'>Sign out</p></a>";
    echo "</div>";
  }
}
?>
