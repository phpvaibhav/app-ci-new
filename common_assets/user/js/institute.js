
         // update profile
        $("#smart-form-updateInfo").validate({

          // Rules for form validation
          rules : {
            name : {
              required  : true
            },
            email : {
              required  : true,
              email     : true
            },
            phoneNumber : {
              required  : true,       
            },
          },

          // Messages for form validation
          messages : {
            name : {
              required : 'Please enter your  name'
            },
            email : {
              required : 'Please enter your email address',
              email    : 'Please enter a valid email address'
            },
            phoneNumber : {
              required : 'Please enter your contact number',
            
            }, 
          },
          // Ajax form submition
         /* submitHandler : function(form) {
           
             return false; // required to block normal submit since you used ajax
          },
*/
          // Do not change code below
          errorPlacement : function(error, element) {
            error.insertAfter(element.parent());
          }
        });
        // update profile                         
// Validation
$(function() {
      
  $(document).on('submit', "#smart-form-updateInfo", function (event) {
    toastr.clear();
    event.preventDefault();
  //  alert(authToken+"   "+base_url+$(this).attr('action'));
    var formData = new FormData(this);
    $.ajax({
        type            : "POST",
        url             : base_url+$(this).attr('action'),
        headers         : { 'authToken': authToken },
        data            : formData, //only input
        processData     : false,
        contentType     : false,
        cache           : false,
        beforeSend      : function () {
            preLoadshow(true);
            $('#submit').prop('disabled', true);
        },
        success         : function (res) {
          preLoadshow(false);
          setTimeout(function(){  $('#submit').prop('disabled', false); },4000);
          if(res.status=='success'){
            toastr.success(res.message, 'Success', {timeOut: 3000});
            setTimeout(function(){window.location.reload(); },4000);
            //setTimeout(function(){ window.location = base_url+'profile/'+res.url; },4000);
          }else{
            toastr.error(res.message, 'Alert!', {timeOut: 4000});
          }         
        }
    });
  });        //fromsubmit
});