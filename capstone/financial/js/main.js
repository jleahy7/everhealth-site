
var needMoreInfo = false;
var needMoreInfo_acct_payable = false;
var invoiceSuccess = false, acctSuccess = false;

var ALL_INPUT_VALID = true;
var VALID_ZIP = /(^\d{5}$)|(^\d{5}-\d{4}$)/;
var VALID_NAME = /^[A-Za-z\s]+$/;
var VALID_ADDRESS = /^[a-zA-Z\s\d\/\#\.]*\d[a-zA-Z\s\d\/]*$/;
var VALID_SKU = /^[a-z0-9A-Z\-\ ]{10,20}/;

var INVALID_MARK = "<img src='assets/cross-mark.png' id='validation_mark' class='validation_mark'>";
var NEED_MORE_INFO = "Please fill out the bill to and ship to fields correctly.";
var NEED_MORE_ACCT_INFO = "Please fill out all fields correctly.";
var INVOICE_SUCCESS = "Invoice created successfully.";
var ACCT_SUCCESS = "Created account payable successfully.";

$(document).ready(function(){
  if(needMoreInfo){
    $('#messageBox').removeClass('hide');
    $('#messageBox').addClass('show_block');
    $('#messageBox').addClass('red');
    $('#messageBox').text(NEED_MORE_INFO);
    // alert('Please fill out the bill to and ship to fields.');
  }
  if(needMoreInfo_acct_payable){
    console.log('NEED MORE INFO JACKASS');
    $('#messageBox').removeClass('hide');
    $('#messageBox').addClass('show_block');
    $('#messageBox').addClass('red');
    $('#messageBox').text(NEED_MORE_ACCT_INFO);
  }
  if(invoiceSuccess){
    $('#messageBox').removeClass('hide');
    $('#messageBox').removeClass('red');
    $('#messageBox').addClass('show_block');
    $('#messageBox').addClass('green');
    $('#messageBox').text(INVOICE_SUCCESS);
    setTimeout(function(e){
      $('#messageBox').removeClass('show_block');
      $('#messageBox').addClass('hide');
    }, 5000);
    $("#resetForm").trigger('click');
  }
  if(acctSuccess){
    $('#messageBox').removeClass('hide');
    $('#messageBox').removeClass('red');
    $('#messageBox').addClass('show_block');
    $('#messageBox').addClass('green');
    $('#messageBox').text(ACCT_SUCCESS);
    setTimeout(function(e){
      $('#messageBox').removeClass('show_block');
      $('#messageBox').addClass('hide');
    }, 5000);
    $("#resetForm").trigger('click');
  }
  //zip code validation
  $("#billToName").keyup(function(){
    if(validateName($("#billToName").val())){
      $('#validation_mark', $("#billToName").parent('div')).removeClass('show');
      $('#validation_mark', $("#billToName").parent('div')).addClass('hide');
    } else {
      $('#validation_mark', $("#billToName").parent('div')).removeClass('hide');
      $('#validation_mark', $("#billToName").parent('div')).addClass('show');
    }
  });
  $("#shipToName").keyup(function(){
    if(validateName($("#shipToName").val())){
      $('#validation_mark', $("#shipToName").parent('div')).removeClass('show');
      $('#validation_mark', $("#shipToName").parent('div')).addClass('hide');
    } else {
      $('#validation_mark', $("#shipToName").parent('div')).removeClass('hide');
      $('#validation_mark', $("#shipToName").parent('div')).addClass('show');
    }
  });
  $("#billToAddress").keyup(function(){
    console.log("validating : " + $("#billToAddress").val());
    if(validateAddress($("#billToAddress").val())){
      $('#validation_mark', $("#billToAddress").parent('div')).removeClass('show');
      $('#validation_mark', $("#billToAddress").parent('div')).addClass('hide');
    } else {
      $('#validation_mark', $("#billToAddress").parent('div')).removeClass('hide');
      $('#validation_mark', $("#billToAddress").parent('div')).addClass('show');
    }
  });
  $("#shipToAddress").keyup(function(){
    if(validateAddress($("#shipToAddress").val())){
      $('#validation_mark', $("#shipToAddress").parent('div')).removeClass('show');
      $('#validation_mark', $("#shipToAddress").parent('div')).addClass('hide');
    } else {
      $('#validation_mark', $("#shipToAddress").parent('div')).removeClass('hide');
      $('#validation_mark', $("#shipToAddress").parent('div')).addClass('show');
    }
  });
  $("#billToCity").keyup(function(){
    if(validateName($("#billToCity").val())){
      $('#validation_mark', $("#billToCity").parent('div')).removeClass('show');
      $('#validation_mark', $("#billToCity").parent('div')).addClass('hide');
    } else {
      $('#validation_mark', $("#billToCity").parent('div')).removeClass('hide');
      $('#validation_mark', $("#billToCity").parent('div')).addClass('show');
    }
  });
  $("#shipToCity").keyup(function(){
    if(validateName($("#shipToCity").val())){
      $('#validation_mark', $("#shipToCity").parent('div')).removeClass('show');
      $('#validation_mark', $("#shipToCity").parent('div')).addClass('hide');
    } else {
      $('#validation_mark', $("#shipToCity").parent('div')).removeClass('hide');
      $('#validation_mark', $("#shipToCity").parent('div')).addClass('show');
    }
  });

  $("#billToZip").keyup(function(){
    if(validateZip($("#billToZip").val())){
      $('#validation_mark', $("#billToZip").parent('div')).removeClass('show');
      $('#validation_mark', $("#billToZip").parent('div')).addClass('hide');
    } else {
      $('#validation_mark', $("#billToZip").parent('div')).removeClass('hide');
      $('#validation_mark', $("#billToZip").parent('div')).addClass('show');
    }
  });
  $("#shipToZip").keyup(function(){
    if(validateZip($("#shipToZip").val())){
      $('#validation_mark', $("#shipToZip").parent('div')).removeClass('show');
      $('#validation_mark', $("#shipToZip").parent('div')).addClass('hide');
    } else {
      $('#validation_mark', $("#shipToZip").parent('div')).removeClass('hide');
      $('#validation_mark', $("#shipToZip").parent('div')).addClass('show');
    }
  });

  $("#SKU").keyup(function(){
    if(validateSKU($("#SKU").val())){
      $('#validation_mark', $("#SKU").parent('div')).removeClass('show');
      $('#validation_mark', $("#SKU").parent('div')).addClass('hide');
    } else {
      $('#validation_mark', $("#SKU").parent('div')).removeClass('hide');
      $('#validation_mark', $("#SKU").parent('div')).addClass('show');
    }
  });
  $("#quantity").change(function(){
    if(validateQuantity($("#quantity").val())){
      $('#validation_mark', $("#quantity").parent('div')).removeClass('show');
      $('#validation_mark', $("#quantity").parent('div')).addClass('hide');
      if($("#unitCost").val() >= 0 && $("#quantity").val() >= 0){
        let formattedVal = $("#unitCost").val() * $("#quantity").val();
        formattedVal = (formattedVal).toFixed(2);
        $("#totalCost").val(formattedVal);
      }
    } else {
      $('#validation_mark', $("#quantity").parent('div')).removeClass('hide');
      $('#validation_mark', $("#quantity").parent('div')).addClass('show');
    }
  });
  $("#quantity").keyup(function(){
    if(validateQuantity($("#quantity").val())){
      $('#validation_mark', $("#quantity").parent('div')).removeClass('show');
      $('#validation_mark', $("#quantity").parent('div')).addClass('hide');
      if($("#unitCost").val() >= 0 && $("#quantity").val() >= 0){
        let formattedVal = $("#unitCost").val() * $("#quantity").val();
        formattedVal = (formattedVal).toFixed(2);
        $("#totalCost").val(formattedVal);
      }
    } else {
      $('#validation_mark', $("#quantity").parent('div')).removeClass('hide');
      $('#validation_mark', $("#quantity").parent('div')).addClass('show');
    }
  });
  $("#unitCost").change(function (){
    if(validateQuantity($("#unitCost").val())){
      $('#validation_mark', $("#unitCost").parent('div')).removeClass('show');
      $('#validation_mark', $("#unitCost").parent('div')).addClass('hide');
      if($("#unitCost").val() >= 0 && $("#quantity").val() >= 0){
        let formattedVal = $("#unitCost").val() * $("#quantity").val();
        formattedVal = (formattedVal).toFixed(2);
        $("#totalCost").val(formattedVal);
      }
    } else {
      $('#validation_mark', $("#unitCost").parent('div')).removeClass('hide');
      $('#validation_mark', $("#unitCost").parent('div')).addClass('show');
    }
  });
  $("#unitCost").keyup(function(){
    if(validateQuantity($("#unitCost").val())){
      $('#validation_mark', $("#unitCost").parent('div')).removeClass('show');
      $('#validation_mark', $("#unitCost").parent('div')).addClass('hide');
      if($("#unitCost").val() >= 0 && $("#quantity").val() >= 0){
        let formattedVal = $("#unitCost").val() * $("#quantity").val();
        formattedVal = (formattedVal).toFixed(2);
        $("#totalCost").val(formattedVal);
      }
    } else {
      $('#validation_mark', $("#unitCost").parent('div')).removeClass('hide');
      $('#validation_mark', $("#unitCost").parent('div')).addClass('show');
    }
  });
  $("#totalCost").prop('disabled', true);
  $("#saveForm").submit(function(e){
    alert();
  });
  $("#acctName").keyup(function(){
    if(validateName($("#acctName").val())){
      $('#validation_mark', $("#acctName").parent('div')).removeClass('show');
      $('#validation_mark', $("#acctName").parent('div')).addClass('hide');
    } else {
      $('#validation_mark', $("#acctName").parent('div')).removeClass('hide');
      $('#validation_mark', $("#acctName").parent('div')).addClass('show');
    }
  });
  $("#acctName").change(function(){
    if(validateName($("#acctName").val())){
      $('#validation_mark', $("#acctName").parent('div')).removeClass('show');
      $('#validation_mark', $("#acctName").parent('div')).addClass('hide');
    } else {
      $('#validation_mark', $("#acctName").parent('div')).removeClass('hide');
      $('#validation_mark', $("#acctName").parent('div')).addClass('show');
    }
  });
  $("#credit").keyup(function(){
    if(validateQuantity($("#credit").val())){
      $('#validation_mark', $("#credit").parent('div')).removeClass('show');
      $('#validation_mark', $("#credit").parent('div')).addClass('hide');
    } else {
      $('#validation_mark', $("#credit").parent('div')).removeClass('hide');
      $('#validation_mark', $("#credit").parent('div')).addClass('show');
    }
  });
  $("#credit").change(function (){
    if(validateQuantity($("#credit").val())){
      $('#validation_mark', $("#credit").parent('div')).removeClass('show');
      $('#validation_mark', $("#credit").parent('div')).addClass('hide');
    } else {
      $('#validation_mark', $("#credit").parent('div')).removeClass('hide');
      $('#validation_mark', $("#credit").parent('div')).addClass('show');
    }
  });
  $("#invoice_number").keyup(function(){
    if(validateQuantity($("#invoice_number").val())){
      $('#validation_mark', $("#invoice_number").parent('div')).removeClass('show');
      $('#validation_mark', $("#invoice_number").parent('div')).addClass('hide');
    } else {
      $('#validation_mark', $("#invoice_number").parent('div')).removeClass('hide');
      $('#validation_mark', $("#invoice_number").parent('div')).addClass('show');
    }
  });
  $("#invoice_number").change(function (){
    if(validateQuantity($("#invoice_number").val())){
      $('#validation_mark', $("#invoice_number").parent('div')).removeClass('show');
      $('#validation_mark', $("#invoice_number").parent('div')).addClass('hide');
    } else {
      $('#validation_mark', $("#invoice_number").parent('div')).removeClass('hide');
      $('#validation_mark', $("#invoice_number").parent('div')).addClass('show');
    }
  });
  $("#debit").keyup(function(){
    if(validateQuantity($("#debit").val())){
      $('#validation_mark', $("#debit").parent('div')).removeClass('show');
      $('#validation_mark', $("#debit").parent('div')).addClass('hide');
    } else {
      $('#validation_mark', $("#debit").parent('div')).removeClass('hide');
      $('#validation_mark', $("#debit").parent('div')).addClass('show');
    }
  });
  $("#debit").change(function (){
    if(validateQuantity($("#debit").val())){
      $('#validation_mark', $("#debit").parent('div')).removeClass('show');
      $('#validation_mark', $("#debit").parent('div')).addClass('hide');
    } else {
      $('#validation_mark', $("#debit").parent('div')).removeClass('hide');
      $('#validation_mark', $("#debit").parent('div')).addClass('show');
    }
  });
});

function validateZip(givenZip){
  ALL_INPUT_VALID = VALID_ZIP.test(givenZip);
  return ALL_INPUT_VALID;
}

function validateName(givenName){
  ALL_INPUT_VALID = VALID_NAME.test(givenName);
  return ALL_INPUT_VALID;
}

function validateAddress(givenAddress){
  ALL_INPUT_VALID = VALID_ADDRESS.test(givenAddress);
  return ALL_INPUT_VALID;
}

function validateSKU(givenSKU){
  ALL_INPUT_VALID = VALID_SKU.test(givenSKU);
  return ALL_INPUT_VALID;
}

function validateQuantity(givenQuantity){
  ALL_INPUT_VALID = (givenQuantity >= 0) ? true : false;
  return ALL_INPUT_VALID;
}

function requestMoreInfo(){
  needMoreInfo = true;
}

function requestMoreInfo_acct_payable(){
  console.log('need more info');
  needMoreInfo_acct_payable = true;
}

function alertSuccess(type){
  console.log('alerting success');
  switch(type){
    case 'invoice': invoiceSuccess = true;
      break;
    case 'acct-payable': acctSuccess = true;
      break;
  }
}
