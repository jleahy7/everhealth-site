<?php

  require_once "vendor/autoload.php";
  include "php/DataBase.php";
  include "php/Info.php";

  $needMoreInfo = false;
  $addAcctResult = false;

  $info = new Info();
  $db = new DataBase();

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if($info->validateAcctPayable()){
      $addAcctResult = $db->addAcctPayable();

    } else {
      $needMoreInfo = true;
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
	<title>Create Account Payable</title>
	<link href="view.css" media="all" rel="stylesheet" type="text/css">
	<script src="view.js" type="text/javascript">
	</script>
	<script src="calendar.js" type="text/javascript">
	</script>
  <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'></script>
  <script src='js/main.js'></script>

</head>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <title>Add Account</title>
      <link rel="stylesheet" type="text/css" href="view.css" media="all">
      <script type="text/javascript" src="view.js"></script>
      <script type="text/javascript" src="calendar.js"></script>
      <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'></script>
      <script src='js/main.js'></script>
   </head>
   <body id="main_body" >
      <img id="top" src="top.png" alt="">
      <div id="form_container">
         <h1><a>Create Account Payable</a></h1>
         <div id='messageBox' class='hide'>
           Successfully created an invoice!
         </div>
         <form id="form_149" class="appnitro keepFormData"  method="post" action="" data-keep-form-data-clear-on-submit="no">
            <div class="form_description">
               <h2>Create Account Payable</h2>
               <p></p>
            </div>
            <ul >
              <li id="li_2" >
                 <label class="description" for="element_1">Account Name </label>
                 <div>
                    <input id='acctName' name="name" class="element text small" type="text" maxlength="255" value=""/>
                    <img src='assets/cross-mark.png' id='validation_mark' class='validation_mark hide'>
                 </div>
              </li>
               <li id="li_1" >
                  <label class="description" for="element_1">Invoice Number </label>
                  <div>
                     <input id='invoice_number' name="invoice_ID" class="element text small" type="text" maxlength="255" value=""/>
                     <img src='assets/cross-mark.png' id='validation_mark' class='validation_mark hide'>
                  </div>
               </li>
               <li id="li_3" >
                  <label class="description" for="element_3">Description </label>
                  <div>
                     <textarea id='description' name="description" class="element textarea medium"></textarea>
                     <img src='assets/cross-mark.png' id='validation_mark' class='validation_mark hide'>
                  </div>
               </li>
               <li id="li_1" >
                  <label class="description" for="element_1">Credit </label>
                  <div>
                     $<input id='credit' name="credit" class="element text small" type="text" maxlength="255" value=""/>
                     <img src='assets/cross-mark.png' id='validation_mark' class='validation_mark hide'>
                  </div>
               </li>
               <li id="li_1" >
                  <label class="description" for="element_1">Debit </label>
                  <div>
                     $<input id='debit' name="debit" class="element text small" type="text" maxlength="255" value=""/>
                     <img src='assets/cross-mark.png' id='validation_mark' class='validation_mark hide'>
                  </div>
               </li>
               <li class="buttons">
                  <input type="hidden" name="form_id" value="149" />
                  <input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" />
                  <input id="reset_Form" class="button_text" type="reset" name="reset" value="Reset"/>
               </li>
            </ul>
         </form>
         <div id="footer">
         </div>
      </div>
      <img id="bottom" src="bottom.png" alt="">
      <script>window.jQuery || document.write(unescape('%3Cscript type="text/javascript" src="jquery-2.1.0.min.js">%3C/script>'))</script>

      <script type="text/javascript" src="js/jquery.keepFormData.min.js"></script>
   </body>
</html>

<?php
  if($needMoreInfo){
    echo "<script>requestMoreInfo();</script>";
  } else if(isset($addAcctResult)){
    if($addAcctResult != false){
      echo "<script>alertSuccess('acct-payable')</script>";
    } else {
      echo "<script>requestMoreInfo();</script>";
    }
  }
?>
