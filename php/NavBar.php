<?php
class NavBar{

  private $page, $info;

  function __construct($_page, $_info){

    $this->page = $_page;
    $this->info = $_info;

    echo "<div id='navbar'>";
    echo "<a href='index.php'><p class='nav-link'>Home</p></a>";
    echo "<a href='locations.php'><p class='nav-link'>Locations</p></a>";
    echo "<a href='membership.php'><p class='nav-link'>Memberships</p></a>";
    echo "<a href='about-us.php'><p class='nav-link'>About Us</p></a>";
    echo "<a href='contact.php'><p class='nav-link'>Contact Us</p></a>";
    echo "</div>";
  }
}
?>
