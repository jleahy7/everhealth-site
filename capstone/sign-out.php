<?php
  echo 'lets sign you out :)';
  setcookie('account_username');
  header('Location: sign-in.php');

 ?>
