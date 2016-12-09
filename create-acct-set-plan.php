<?php

  if(isset($_GET['plan'])){
    setcookie('chosen-plan', $_GET['plan']);
    header("Location: create-acct.php");
  }

 ?>
