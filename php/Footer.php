<?php

class Footer{

  private $page, $info;

  function __construct($_page, $_info){

    $this->page = $_page;
    $this->info = $_info;
    echo "<div id='footer'>";
    echo "<p id='footer-p'>Ever Health - 550 East Spring St. Columbus, OH 43215 - (614)287-5353 - <a href='mailto:everhealth@everhealth.com'>everhealth@everhealth.com</p>";
    echo "</div>";
  }
}
?>
