var textInputs = {
  firstName: " First Name",
  lastName: " Last Name",
  phone: " Phone",
  email: " Email",
  password: " Password",
  verifyPassword: " Verify Password",
  currentPassword: " Current Password",
  username: " Username"
};

var urlVars, currentPage, cardExpire, validEmail = false;

$(document).ready(function(){
  // initialize the page
  currentPage = window.location.pathname.split('/').pop();
  console.log(currentPage);
  //this will need updated for the update pages
  // if(currentPage != 'update-billing-info.php' && currentPage != 'update-profile.php'){
  //
  // }
  init_listeners();
  try{
    if(urlVars['alert'] != null){
      switch(urlVars['alert']){
        case 'change-pass-success':
          alert('Successfully changed password!');
          break;
        case 'cancel-plan-success':
          alert('Successfully canceled plan!');
          window.location.replace('my-acct.php');
          break;
        case 'change_plan_success':
          alert('Successfully changed membership plan!');
          window.location.replace('my-acct.php');
          break;
        case 'change_billing_info_success':
          alert('Successfully changed billing information!');
          window.location.replace('my-acct.php');
          break;
        case 'update_profile_success':
          alert('Successfully changed profile information!');
          window.location.replace('my-acct.php');
          break;
        case 'contact_us_success':
          alert('Your message was successfully sent.  Please allow 3 business days for a response.');
          break;
        case 'contact_us_failed':
          alert("Your message could not be sent at this time.  Please try again later.");
          break;
      }
    }
  } catch (error){

  }

});

function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
      vars[key] = value;
    });
    return vars;
  }

function init_listeners(){
  console.log("init listeners");
  $("#create-acct-form").submit(validateForm);
  $("#update-profile-form").submit(validateForm);

  $("#expire-year").change(validateExpireDate);
  $("#expire-month").change(validateExpireDate);
  $("#contact-form").submit(validateContactUs);
  $("input[type='email']").on('keyup', function(){
    if(validateEmail($("#contact-user-email").val())){
      $("#email-error-p").addClass('hide');
      console.log('passed');
    } else {
      $("#email-error-p").removeClass('hide');
      console.log('failed');
    }
  });
  $("#email").on('keyup', function(){
    if(validateEmail($(this).val())){
      $("#email-error-p").removeClass('hide');
      console.log('passed');
    } else {
      $("#email-error-p").addClass('hide');
      console.log('failed');
    }
  })
  // $("input[type='text']").focus(function(){
  //   var fieldValue = $(this).attr('value');
  //   var id = $(this).attr('id');
  //   let classes = $(this).attr("class").split(' ');
  //   console.debug(classes);
  //   if(currentPage != 'update-profile' || currentPage != 'update-profile.php'){
  //     if(id == 'password' || id == 'verifyPassword'){
  //       $(this).attr('type', 'password');
  //       $(this).change(function (){
  //       });
  //     }
  //     $("#"+id).focusout(function(id){
  //       console.log("$(this).attr('id') : " + $(this).attr('id'));
  //       if($(this).val() == '' && $(this).attr('id') != "email"){
  //         $(this).attr('value', textInputs[$(this).attr('id')]);
  //         $(this).attr('type', 'text');
  //       } else {
  //
  //       }
  //     });
  //     // $(this).attr('value', '');
  //   }
  // });
  // $("input[type='email']").focus(function(){
  //   var fieldValue = $(this).attr('value');
  //   var id = $(this).attr('id');
  //   $("#"+id).focusout(function(id){
  //     if($(this).val() == ''){
  //       $(this).attr('value', textInputs[$(this).attr('id')]);
  //       $(this).attr('type', 'text');
  //     } else {
  //
  //     }
  //   });
  //   $(this).attr('value', '');
  // });

  $("input[type='tel']").click(phoneListener);
  $("input[type='tel']").focus(phoneListener);


  // // $("input[type='password']").click(function(){
  //   var fieldValue = $(this).attr('value');
  //   var id = $(this).attr('id');
  //   console.log("click id : " + id);
  //   $("#"+id).focusout(function(id){
  //     if($(this).val() == ''){
  //       $(this).attr('value', textInputs[$(this).attr('id')]);
  //     }
  //   });
  //   $(this).attr('value', '');
  // });

  $("div.change-plan").click(function(){
    $('#chosen-plan').attr('value', $(this).attr('id'));
    switch($(this).attr('id')){
      case "gold":
        $(this).addClass('selected-plan');
        $('div#silver').removeClass('selected-plan');
        $('div#bronze').removeClass('selected-plan');
        break;
      case "silver":
        $('div#gold').removeClass('selected-plan');
        $(this).addClass('selected-plan');
        $('div#bronze').removeClass('selected-plan');
          break;
      case "bronze":
        $('div#gold').removeClass('selected-plan');
        $('div#silver').removeClass('selected-plan');
        $(this).addClass('selected-plan');
            break;
    }
  });

  $('#reset-change-plan').click(function(){
    window.location.replace('my-acct.php');
  });


  urlVars = getUrlVars();

  console.log('url vars : ' + console.debug(urlVars));
}

function validateForm(sumbitEvent){
  console.log("address : " + $("#address").val());
  console.log("address2 : " + $("#address2").val());
  console.log("state : " + $("#state").val());
  console.log("city : " + $("#city").val());
  console.log("zip : " + $("#zip").val());
    if(currentPage == "update-billing-info.php"){
      if($("#cardHolder").val() == undefined ||  $("#cardHolder").val() == "" || $("#cardNumber").val() == undefined ||  $("#cardNumber").val() == "" || $("#cvv").val() == undefined ||  $("#cvv").val() == "" || (document.getElementById('debit_radio').checked == false && document.getElementById('credit_radio').checked == false )){
        //check if cvv if 3 characters long
        if($("#cardHolder").val() == '' || !validateName($("#cardHolder").val())){
          sumbitEvent.preventDefault();
          alert('Please enter a valid card holder name.');
        } else if($("#cardNumber").val() == ''){
          sumbitEvent.preventDefault();
          alert('Please enter a valid card number.');
        } else if($("#expire-month").val() == "Expire Month"){
          sumbitEvent.preventDefault();
          alert('Please select a month.');
        } else if ($("#cvv").val().length != 3 || validateCVV($("#cvv").val()) == false){
          sumbitEvent.preventDefault();
          alert('Please make sure your cvv is 3 digits.');
        } else if((document.getElementById('debit_radio').checked == false && document.getElementById('credit_radio').checked == false )) {
          sumbitEvent.preventDefault();
          alert('Please check either credit or debit.');
        }

      } else if (validateCard($("#cardNumber").val()) == false){
        sumbitEvent.preventDefault();
        alert('Please enter a valid card number with no spaces i.e. 6011000000000004');
      }
    } else if (currentPage == "create-acct-step3.php"){
      //step 3 validation
      if($("#cardHolder").val() == undefined ||  $("#cardHolder").val() == "" || $("#cardNumber").val() == undefined ||  $("#cardNumber").val() == "" || $("#cvv").val() == undefined ||  $("#cvv").val() == "" || (document.getElementById('debit_radio').checked == false && document.getElementById('credit_radio').checked == false )){
        //check if cvv if 3 characters long
        if($("#cardHolder").val() == '' || !validateName($("#cardHolder").val())){
          sumbitEvent.preventDefault();
          alert('Please enter a valid card holder name.');
        } else if($("#cardNumber").val() == ''){
          sumbitEvent.preventDefault();
          alert('Please enter a valid card number.');
        } else if($("#expire-month").val() == "Expire Month"){
          sumbitEvent.preventDefault();
          alert('Please select a month.');
        } else if ($("#cvv").val().length != 3 || validateCVV($("#cvv").val()) == false){
          sumbitEvent.preventDefault();
          alert('Please make sure your cvv is 3 digits.');
        } else if((document.getElementById('debit_radio').checked == false && document.getElementById('credit_radio').checked == false )) {
          sumbitEvent.preventDefault();
          alert('Please check either credit or debit.');
        }

      } else if (validateCard($("#cardNumber").val()) == false){
        sumbitEvent.preventDefault();
        alert('Please enter a valid card number with no spaces i.e. 6011000000000004');
      } else if ($("#address").val() == undefined ||  $("#address").val() == "" || $("#city").val() == undefined ||  $("#state").val() == "" || $("#zip").val() == "" ||  $("#zip").val() == undefined){
          if($("#address").val() == undefined ||  $("#address").val() == "" || validateAddress($("#address").val()) == false){
            sumbitEvent.preventDefault();
            alert("Please provide a valid address for address line 1.");
          } else if($("#address2").val() != "" && validateAddress($("#address2").val()) == false){
            sumbitEvent.preventDefault();
            alert("Please provide a valid address for address line 2.");
          } else if($("#city").val() == undefined ||  $("#city").val() == "" || validateCity($("#city").val()) == false){
            sumbitEvent.preventDefault();
            alert("Please provide a valid city.");
          } else if($("#state").val() == undefined ||  $("#state").val() == ""){
            sumbitEvent.preventDefault();
            alert("Please provide a state.");
          }
      } else if($("#zip").val() == undefined ||  $("#zip").val() == "" || validateZip($("#zip").val()) == false){
        sumbitEvent.preventDefault();
        alert("Please provide a ZIP code.");
      }
    } else if (currentPage == "update-profile" || currentPage == "update-profile.php"){
      console.log('validating email : ' + $("#email").val());
      validEmail = validateEmail($("#email").val());
      if(!validEmail){
        sumbitEvent.preventDefault();
        alert('Please provide a valid email.');
      }
    } else if (currentPage == 'create-acct-step2' || currentPage == "create-acct-step2.php"){
      console.log("$('#firstName').val() : " + $("#firstName").val());
      console.log("$('#lastName').val() : " + $("#lastName").val());
      console.log("$('#tele').val() : " + $("#phone").val());
      console.log("$('#email').val() : " + $("#email").val());
      let allReqFieldsFilled = false;
      if($("#firstName").val() == undefined || $("#firstName").val() == '' || $("#lastName").val() == undefined || $("#lastName").val() == '' || $("#phone").val() == undefined ||  $("#phone").val() == "" ||  $("#email").val() == "" || $("#email").val() == undefined){
        sumbitEvent.preventDefault();
        alert("Please fill out all fields.");
      } else if ($("#location-select").val() == "default"){
        sumbitEvent.preventDefault();
        alert("Please select a location.");
      }
    } else if(currentPage == "create-acct-step3.php" || currentPage == "create-acct-step3"){

    }
}

function validateCard(card){
  let cards = {
    visa: new RegExp("^4[0-9]{12}(?:[0-9]{3})?$"),
    mastercard: new RegExp("^(?:5[1-5][0-9]{2}|222[1-9]|22[3-9][0-9]|2[3-6][0-9]{2}|27[01][0-9]|2720)[0-9]{12}$"),
    americanExpress: new RegExp("^3[47][0-9]{13}$"),
    discover: new RegExp("^6(?:011|5[0-9]{2})[0-9]{12}$")
  }
  if(cards.visa.test(card) || cards.mastercard.test(card) || cards.americanExpress.test(card) || cards.discover.test(card)){
    console.log('valid card');
    return true;
  } else {
    console.log('invlaid card');
    return false;
  }
}

function validateCVV(cvv){
  return /([0-9]){3}/.test(cvv);
}

function validateCity(city){
  return /^[a-zA-Z]+(?:[\s-][a-zA-Z]+)*$/.test(city);
}

function validateZip(zip){
  console.log("validating zip : " + zip + " result : " + /(^\d{5}$)|(^\d{5}-\d{4}$)/.test(zip));
  return /(^\d{5}$)|(^\d{5}-\d{4}$)/.test(zip);
}
function validateAddress(address){
  return /^[,-.#a-zA-Z\s\d\/]*[a-zA-Z\s\d\/]*$/.test(address);
}

function validateContactUs(submitEvent){
  if(validEmail){
    console.log('submitting . . .');
  } else {
    alert("Please provide a valid email.");
    submitEvent.preventDefault();
  }
}


function validateExpireDate(){
    cardExpire = $("#expire-year").val() + "-" + $("#expire-month").val() + "-01";
    var selectedDate = new Date(cardExpire);
    var selectedMonth = ($("#expire-month").val()-1);
    var now = new Date();
    if (selectedDate < now && now.getMonth() != selectedMonth) {
      if($("#expire-date-error").hasClass('hide')){
        $("#expire-date-error").removeClass('hide');
        $("#expire-date-error").addClass('show');

      }
      document.getElementById('submitForm').disabled = true;
    } else {
      if($("#expire-date-error").hasClass('show')){
        $("#expire-date-error").removeClass('show');
        $("#expire-date-error").addClass('hide');
        document.getElementById('submitForm').disabled = false;
      }
    }
}

function phoneListener(){
  console.log("value of tel : " + $(this).val());
  var fieldValue = $(this).attr('value');
  var id = $(this).attr('id');
  $('#phone').mask('(000) 000-0000');
  $("#"+id).focusout(function(id){

    // if($(this).val() == ''){
    //   $(this).attr('value', textInputs[$(this).attr('id')]);
    //   $(this).attr('type', 'text');
    // }


  });
  $("input[type='tel']").change(function (){
    if($(this).val() != textInputs['phone']){
      $('#phone').mask('(000) 000-0000');
    }
  });
  // $(this).attr('value', '');
}

function confirmAction(type){
  switch(type){
    case 'cancel-plan':
      if(confirm('Are you sure you want to cancel your memberhsip plan?'))
        window.location.replace('cancel-membership.php');
      break;
  }
}

function validateName(name){
  return (/([A-Z])\w+/.test(name));
}

function validateEmail(email){
  validEmail = (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test( email ));
	return validEmail;
}

function gotoMyAcct(){
  window.location.replace('my-acct.php');
}
