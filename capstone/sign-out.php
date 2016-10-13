<?php

if(isset($_COOKIE['account_username'])){
  echo 'lets sign you out :)';
  setcookie('account_username');
  header('Location: sign-in.php');
}

 ?>
