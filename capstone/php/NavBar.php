<?php
class NavBar{

  private $page, $info;

  function __construct($_page, $_info){

    $this->page = $_page;
    $this->info = $_info;
    
    echo "<div id='navbar'>";
    echo "<a href='#'><p class='nav-link'>Home</p></a>";
    echo "<a href='#'><p class='nav-link'>Locations</p></a>";
    echo "<a href='#'><p class='nav-link'>Memberships</p></a>";
    echo "<a href='#'><p class='nav-link'>About Us</p></a>";
    echo "</div>";
  }
}
?>
