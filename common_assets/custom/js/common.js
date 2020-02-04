var base_url  = $('body').data('base-url'); // Base url
var authToken = $('body').data('auth-url'); // Base url
var errorClass = 'invalid';
var errorElement = 'em';
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