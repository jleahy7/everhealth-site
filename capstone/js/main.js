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

var urlVars, currentPage;

$(document).ready(function(){
  // initialize the page
  currentPage = window.location.pathname.split('/').pop();
  console.log(currentPage);
  //this will need updated for the update pages
  if(currentPage != 'update-billing-info.php' && currentPage != 'update-profile.php'){
    init_listeners();
  }
  if(urlVars['alert'] != null){
    switch(urlVars['alert']){
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
    }
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
  $("input[type='text']").focus(function(){
    var fieldValue = $(this).attr('value');
    var id = $(this).attr('id');
    if(id == 'password' || id == 'verifyPassword'){
      $(this).attr('type', 'password');
      $(this).change(function (){
      });
    }
    $("#"+id).focusout(function(id){
      if($(this).val() == ''){
        $(this).attr('value', textInputs[$(this).attr('id')]);
        $(this).attr('type', 'text');
      } else {

      }
    });
    $(this).attr('value', '');
  });
  $("input[type='email']").focus(function(){
    var fieldValue = $(this).attr('value');
    var id = $(this).attr('id');
    $("#"+id).focusout(function(id){
      if($(this).val() == ''){
        $(this).attr('value', textInputs[$(this).attr('id')]);
        $(this).attr('type', 'text');
      } else {

      }
    });
    $(this).attr('value', '');
  });

  $("input[type='tel']").focus(function(){
    var fieldValue = $(this).attr('value');
    var id = $(this).attr('id');
    $("#"+id).focusout(function(id){
      if($(this).val() == ''){
        $(this).attr('value', textInputs[$(this).attr('id')]);
        $(this).attr('type', 'text');
      } else {

      }
    });
    $(this).attr('value', '');
  });

  $("input[type='password']").click(function(){
    var fieldValue = $(this).attr('value');
    var id = $(this).attr('id');
    console.log("click id : " + id);
    $("#"+id).focusout(function(id){
      if($(this).val() == ''){
        $(this).attr('value', textInputs[$(this).attr('id')]);
      }
    });
    $(this).attr('value', '');
  });

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

function confirmAction(type){
  switch(type){
    case 'cancel-plan':
      if(confirm('Are you sure you want to cancel your memberhsip plan?'))
        window.location.replace('cancel-membership.php');
      break;
  }


}
