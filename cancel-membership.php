<?php

  include 'php/DataBase.php';
  require_once "vendor/autoload.php";

  $db = new DataBase();
  if(isset($_COOKIE['account_username'])){
    echo 'we gonna cancel ' . $_COOKIE['account_username'] . "'s memberhsip";
    if(DataBase::change_acct_plan($_COOKIE['account_username'], "canceled")){
      header('Location: my-acct.php?alert=cancel-plan-success');
    } else {
      echo 'unable to cancel you memberhip bro';
    }
  } else {
    header('Location: please-sign-in.php');
  }

 ?>
