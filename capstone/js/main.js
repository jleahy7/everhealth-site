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

$(document).ready(function(){
  // initialize the page
  init();
});

function init(){
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
}
