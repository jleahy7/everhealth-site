<?php

class FloatingNav{

  private $page;

  function __construct($_page, $_info){

    $this->page = $_page;
    $this->info = $_info;
    echo "<div id='floating-nav'>";
    echo "<a href='create-acct.php'><p class='float-nav' id='create-acct-float'>Create Account</p></a>";
    echo "<a href='sign-in.php'><p class='float-nav' id='signin-float'>Sign In</p></a>";
    echo "</div>";
  }
}
?>
