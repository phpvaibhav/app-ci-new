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
//confirmAction
function confirmAction(e){
   toastr.clear();
  swal({
    title               : "Are you sure?",
    text                : $(e).data('message'),
    type                : "warning",
    showCancelButton    : true,
    confirmButtonClass  : "btn-danger",
    confirmButtonText   : "Yes",
    cancelButtonText    : "No",
    closeOnConfirm      : true,
    closeOnCancel       : true,
    // showLoaderOnConfirm: true
  },
  function(isConfirm) {
    if (isConfirm) {
      /*ajax*/
      $.ajax({
              type          : "POST",
              url           : base_url+$(e).data('url'),
              data          : {id:$(e).data('id')},
              headers       : { 'authToken':authToken},
              cache         : false,
              beforeSend    : function() {
                preLoadshow(true);
              },     
              success       : function (res) {
                preLoadshow(false);
                if(res.status=='success'){
                  toastr.success(res.message, 'Success', {timeOut: 3000});
                   //  swal("Success", "Your process  has been successfully done.", "success");
                   if($(e).data('list')==1){
                      $('.dataTables-example-list').DataTable().ajax.reload();
                   }else{
                      setTimeout(function(){window.location.reload(); },2000);
                   }
                  
                   
                }else{
                  toastr.error(res.message, 'Alert!', {timeOut: 5000});
                }             
              }
            });
      /*ajax*/
    } else {
    //swal("Cancelled", "Your Process has been Cancelled", "error");
    }
  });
}
//confirmAction     