var textInputs = {
  firstName: " First Name",
  lastName: " Last Name",
  phone: " Phone",
  email: " Email",
  password: " Password",
  verifyPassword: " Verify Password",
  currentPassword: " Currebt Password"
};

$(document).ready(function(){
  // initialize the page
  init();
});

function init(){
  $("input[type='text']").click(function(){
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
}
