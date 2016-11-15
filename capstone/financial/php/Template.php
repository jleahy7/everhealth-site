<?php

include "php/Header.php";
include "php/MainContent.php";

class Template{

  private $page;

  function __construct($_page){
    $this->page = $_page;
    // $this->init_db();
    $this->page = $_page;
    $header = new Header($this->page);
    $mainContent = new MainContent($this->page);
  }

}

 ?>
