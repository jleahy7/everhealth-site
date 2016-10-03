<?php

class FloatingNav{

  private $page;

  function __construct($__page){

    $this->page = $__page;

    echo "<div id='floating-nav'>";
    echo "<a href='create-acct.php'><p class='float-nav' id='create-acct-float'>Create Account</p></a>";
    echo "<a href='sign-in.php'><p class='float-nav' id='signin-float'>Sign In</p></a>";
    echo "</div>";
  }
}
?>
