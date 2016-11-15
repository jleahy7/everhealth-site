<?php

  require_once "vendor/autoload.php";
  include "php/DataBase.php";
  include "php/Info.php";

  $needMoreInfo = false;
  $invoiceResult;

  $info = new Info();
  $db = new DataBase();

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if($info->validateInvoice()){
      $invoiceResult = $db->addInvoice();

    } else {
      $needMoreInfo = true;
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
	<title>Invoice</title>
	<link href="view.css" media="all" rel="stylesheet" type="text/css">
	<script src="view.js" type="text/javascript">
	</script>
	<script src="calendar.js" type="text/javascript">
	</script>
  <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'></script>
  <script src='js/main.js'></script>
  <?php
    if($needMoreInfo){
      echo "<script>needMoreInfo_acct_payable = true;</script>";
    } else if(isset($invoiceResult)){
      echo "<script>alertSuccess('invoice')</script>";
    }
  ?>
</head>
<body id="main_body">
	<img alt="" id="top" src="top.png">
	<div id="form_container">
		<h1><a>Invoice</a></h1>

		<form action="" class="appnitro keepFormData" id="form_2774" method="post" name="form_2774" data-keep-form-data-clear-on-submit="yes">
			<div class="form_description">
				<h2 class='same-line'>Create an Invoice</h2>
        <div id='messageBox' class='hide'>
          Successfully created an invoice!
        </div>
			</div>
			<ul>
        <input class="button_text" id="resetForm" name="clear" type="reset" value="Reset">
					<h2>BILL TO</h2>
          <li id="li_3">
  					<label class="description" for="element_3">Name</label>
  					<div>
  						<input class="element text medium" id="billToName" maxlength="255" name="bill_to" type="text" value="">
              <img src='assets/cross-mark.png' id='validation_mark' class='validation_mark hide'>
            </div>
  				</li>
				<li id="li_3">
					<label class="description" for="element_3">Address</label>
					<div>
						<input class="element text large" id="billToAddress" maxlength="255" name="bill_to_address" type="text" value="">
            <img src='assets/cross-mark.png' id='validation_mark' class='validation_mark hide'>
          </div>
				</li>
				<li id="li_4">
					<label class="description" for="element_4">City</label>
					<div>
						<input class="element text medium" id="billToCity" maxlength="255" name="bill_to_city" type="text" value="">
            <img src='assets/cross-mark.png' id='validation_mark' class='validation_mark hide'>
          </div>
				</li>
				<li id="li_15">
					<label class="description" for="element_15">State</label>
					<div>
						<select class="element select medium" id="billToState" name="bill_to_state">
							<option selected="selected" value="">
							</option>
              <?php
                foreach ($info->states as $key => $value) {
                  echo "<option value=" . $key . ">";
    							echo "$value";
    							echo "</option>";
                }
              ?>
						</select>
            <img src='assets/cross-mark.png' id='validation_mark' class='validation_mark hide'>
					</div>
				</li>
				<li id="li_5">
					<label class="description" for="element_5">Zip Code</label>
					<div>
						<input class="element text medium" id="billToZip" maxlength="18" name="bill_to_zip" type="text" value="">
            <img src='assets/cross-mark.png' id='validation_mark' class='validation_mark hide'>
          </div>
				</li>
				<li class="section_break">
					<h2>SHIP TO</h2>
					<p></p>
				</li>
        <li id="li_3">
          <label class="description" for="element_3">Name</label>
          <div>
            <input class="element text medium" id="shipToName" maxlength="255" name="ship_to" type="text" value="">
            <img src='assets/cross-mark.png' id='validation_mark' class='validation_mark hide'>
          </div>
        </li>
				<li id="li_6">
					<label class="description" for="element_6">Address</label>
					<div>
						<input class="element text large" id="shipToAddress" maxlength="255" name="ship_to_address" type="text" value="">
            <img src='assets/cross-mark.png' id='validation_mark' class='validation_mark hide'>
					</div>
				</li>
				<li id="li_7">
					<label class="description" for="element_7">City</label>
					<div>
						<input class="element text medium" id="shipToCity" maxlength="255" name="ship_to_city" type="text" value="">
            <img src='assets/cross-mark.png' id='validation_mark' class='validation_mark hide'>
					</div>
				</li>
				<li id="li_16">
					<label class="description" for="element_16">State</label>
					<div>
						<select class="element select medium" id="shipToState" name="ship_to_state">
							<option selected="selected" value="">
							</option>
              <?php
                foreach ($info->states as $key => $value) {
                  echo "<option value=" . $key . ">";
    							echo "$value";
    							echo "</option>";
                }
              ?>
						</select>
            <img src='assets/cross-mark.png' id='validation_mark' class='validation_mark hide'>
					</div>
				</li>
				<li id="li_8">
					<label class="description" for="element_8">Zip Code</label>
					<div>
						<input class="element text medium" id="shipToZip" maxlength="255" name="ship_to_zip" type="text" value="">
            <img src='assets/cross-mark.png' id='validation_mark' class='validation_mark hide'>
					</div>
				</li>
				<li class="section_break">
					<h2>Additional Information</h2>
					<p></p>
				</li>
				<li id="li_9">
					<label class="description" for="element_9">SKU</label>
					<div>
						<input class="element text medium" id="SKU" maxlength="255" name="sku" type="text" value="">
            <img src='assets/cross-mark.png' id='validation_mark' class='validation_mark hide'>
					</div>
				</li>
				<li id="li_11">
					<label class="description" for="element_11">Quantity</label>
					<div>
						<input class="element text medium" id="quantity" maxlength="255" name="quantity" type="number" value="">
            <img src='assets/cross-mark.png' id='validation_mark' class='validation_mark hide'>
					</div>
				</li>
				<li id="li_12">
					<label class="description" for="element_12">Description</label>
					<div>
						<input class="element text medium" id="description" maxlength="255" name="description" type="text" value="">
            <img src='assets/cross-mark.png' id='validation_mark' class='validation_mark hide'>
					</div>
				</li>
				<li id="li_13">
					<label class="description" for="element_13">Unit Cost</label>
					<div>
						$<input class="element text medium" id="unitCost" maxlength="255" name="price" type="text" value="">
            <img src='assets/cross-mark.png' id='validation_mark' class='validation_mark hide'>
					</div>
				</li>
				<li id="li_14">
					<label class="description" for="element_14">Total</label>
					<div>
						$<input class="element text medium" id="totalCost" maxlength="255" name="total" type="text" value="">
            <img src='assets/cross-mark.png' id='validation_mark' class='validation_mark hide'>
					</div>
				</li>
				<li class="buttons"><input name="form_id" type="hidden" value="2774"> <input class="button_text" id="saveForm" name="submit" type="submit" value="Submit"><input name="form_id" type="hidden" value="2774"> <input class="button_text" id="resetForm" name="clear" type="reset" value="Reset"></li>
			</ul>
		</form>
		<div id="footer"></div>
	</div><img alt="" id="bottom" src="bottom.png">
  <script>window.jQuery || document.write(unescape('%3Cscript type="text/javascript" src="jquery-2.1.0.min.js">%3C/script>'))</script>

  <script type="text/javascript" src="js/jquery.keepFormData.min.js"></script>
</body>
</html>
