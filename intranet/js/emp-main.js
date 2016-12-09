var DEFAULT_USER = "Username", DEFAULT_PASS = "Password";
var currentUsername, currentPassword;

$(document).ready(function(e){

  $("#username").focus(function(){
    var fieldValue = $(this).attr('value');
    var id = $(this).attr('id');
    $(this).attr('value', '');
  });
  $("#username").focusout(function(id){
    if($(this).val() == ''){
      $(this).attr('value', DEFAULT_USER);
    }
  });
  $("#password").focus(function(){
    var fieldValue = $(this).attr('value');
    var id = $(this).attr('id');
    $(this).attr('value', '');
  });
  $("#password").focusout(function(id){
    if($(this).val() == ''){
      $(this).attr('value', DEFAULT_PASS);
    }
  });
});

function checkUserDefault(e){
  if(currentUsername = DEFAULT_USER){
    $("#username").val('');
  }
}

function usernameInput(e){
  currentUsername = $("#username").val();
}

function passwordInput(e){


}
