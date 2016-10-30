<?php

class Header{

  private $page, $info;

  function __construct($_page, $_info){

    $this->page = $_page;
    $this->info = $_info;
    echo "<head>";
    echo "<meta charset='UTF-8'>";
    echo "<title>Create Account</title>";
    echo "<meta name='author' content='James Leahy'>";
    echo "<meta name='description' content='sample page for Ever Health'>";
    echo "<meta name='keyword' content='Ever Health, create account'>";
    echo "<link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet'>";
    echo "<link rel='stylesheet' type='text/css' href='css/styles.css'?>";
    echo "<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'></script>";
    echo "<script src='js/main.js'></script>";
    echo "</head>";
  }
}

?>
