<?php

class Footer{

  private $page;

  function __construct($__page){

    $this->page = $__page;
    echo "<div id='footer'>";
    echo "<p id='footer-p'>Ever Health - 550 East Spring St. Columbus, OH 43215 - (614)287-5353 - everhealth@everhealth.com</p>";
    echo "</div>";
  }
}
?>
