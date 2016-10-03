<?php
include 'php/Header.php';
include 'php/FloatingNav.php';
include 'php/Masthead.php';
include 'php/NavBar.php';
include 'php/MainContent.php';
include 'php/Footer.php';

class Template{

  public $header, $mast, $footer, $floatingNav, $navBar, $mainContent;
  private $page;

  function __construct($__page){

    $this->page = $__page;

    $header = new Header($this->page);
    // echo the wrapper
    echo "<body>";
    echo "<div id='wrapper'>";
    $floatingNav = new FloatingNav($this->page);
    $mast = new Masthead($this->page);
    $navBar = new NavBar($this->page);
    $mainContent = new MainContent($this->page);
    echo "</div>";
    $footer = new Footer($this->page);
  }
}
?>
