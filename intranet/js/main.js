var TRAINING = 'training', OFFICE = 'office', GYM = 'gym'
var curIDString;

$(document).ready(function(e){
  console.log('document loaded');
});

function showDocs(type){
  curIDString = "#docs-dialog-".concat(type);
  // switch(type){
  //   case TRAINING: idString.concat(TRAINING)
  //     break;
  //   case OFFICE:
  //     break;
  //   case GYM:
  //     break;
  // }
  $(curIDString).removeClass('hide-dialog');
  $(curIDString).addClass('show-dialog');
  console.log("curIDString : " + curIDString);
}

function closeDocs(){
  $(curIDString).addClass('hide-dialog');
}
