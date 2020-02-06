$(document).ready(function(){
    $('.dataTables-example').DataTable({
        pageLength: 25,
        responsive: true,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            { extend: 'copy'},
            {extend: 'csv'},
            {extend: 'excel', title: 'ExampleFile'},
            {extend: 'pdf', title: 'ExampleFile'},

            {extend: 'print',
             customize: function (win){
                    $(win.document.body).addClass('white-bg');
                    $(win.document.body).css('font-size', '10px');

                    $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
            }
            }
        ]

    });
/*Add */
$("#form-teacher").validate({// Rules for form validation
  errorClass    : errorClass,
  errorElement  : errorElement,
  highlight: function(element) {
    $(element).parent().removeClass('state-success').addClass("state-error");
    $(element).removeClass('valid');
  },
  unhighlight: function(element) {
    $(element).parent().removeClass("state-error").addClass('state-success');
    $(element).addClass('valid');
  },
  rules : {
    fristName : {
      required : true
    },
    lastName : {
      required : true
    }, 
    email : {
      required  : true,
      email     : true
    }, 
     contact : {
      required  : true,
    
    },
    password : {
      required  : true,
      minlength : 3,
      maxlength : 20
    },
    c_password : {
      required  : true,
      minlength : 3,
      maxlength : 20,
      equalTo   : '#password'
    },
  },
  // Messages for form validation
  messages : {
        fristName : {
            required : 'Please enter your frist name'
        },
        lastName : {
            required : 'Please enter your last name',
        },
        email : {
            required  : 'Please enter your email address',
            email     : 'Please enter a valid email address'
        },
        contact : {
            required  : 'Please enter your contact number'
        },
        password : {
          required  : 'Please enter your password'
        },
        c_password : {
          required  : 'Please re-enter your password',
          equalTo   : 'Please enter the same password as above'
        }

    },
    // Ajax form submition
    submitHandler : function(form) {
        toastr.clear();
        $('#submit').prop('disabled', true);
        $.ajax({
            type: "POST",
            url: base_url+$(form).attr('action'),
            headers: { 'authToken':authToken},
            data: $(form).serialize(),
            cache: false,
            beforeSend: function() {
              preLoadshow(true);
              $('#submit').prop('disabled', true);  
            },     
            success: function (res) {
              preLoadshow(false);
              setTimeout(function(){  $('#submit').prop('disabled', false); },4000);
              if(res.status=='success'){
                toastr.success(res.message, 'Success', {timeOut: 3000});
                setTimeout(function(){window.location.reload(); },4000);
              //  setTimeout(function(){ window.location = base_url+'jobs';; },4000);
              }else{
                toastr.error(res.message, 'Alert!', {timeOut: 4000});
              }
            }
        });
        return false; // required to block normal submit since you used ajax
      },
       onfocusout: injectTrim($.validator.defaults.onfocusout),
      // Do not change code below
      errorPlacement : function(error, element) {
        error.insertAfter(element.parent());
      }
});
/*Add */
});