<?php
class NavBar{

  private $page;

  function __construct($__page){

    $this->page = $__page;
    echo "<div id='navbar'>";
    echo "<a href='#'><p class='nav-link'>Home</p></a>";
    echo "<a href='#'><p class='nav-link'>Locations</p></a>";
    echo "<a href='#'><p class='nav-link'>Memberships</p></a>";
    echo "<a href='#'><p class='nav-link'>About Us</p></a>";
    echo "</div>";
  }
}
?>
