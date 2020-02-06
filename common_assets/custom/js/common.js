var base_url  = $('body').data('base-url'); // Base url
var authToken = $('body').data('auth-url'); // Base url
var errorClass = 'error';
var errorElement = 'label';
function injectTrim(handler) {
  return function (element, event) {
    if (element.tagName === "TEXTAREA" || (element.tagName === "INPUT" 
                                       && element.type !== "password")) {
      element.value = $.trim(element.value);
    }
    return handler.call(this, element, event);
  };
}
function preLoadshow(x){
  if(x){
    $('#pre-load-dailog').css("display", "block");;
  }else{
    $('#pre-load-dailog').css("display", "none");;
  }
}
// A $( document ).ready() block.
preLoadshow(true);
$( document ).ready(function() {
   preLoadshow(false);
});
toastr.options = {
  closeButton: true,
  progressBar: true,
  showMethod: 'slideDown',
  timeOut: 3000
};