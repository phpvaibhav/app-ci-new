/*Add */
$("#form-add").validate({// Rules for form validation
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
    name : {
      required : true
    }, 
  },
  // Messages for form validation
  messages : {
        name : {
            required : 'Please enter your name'
        }, 
    },
    // Ajax form submition
/*    submitHandler : function(form) {
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
                setTimeout(function(){window.location.reload();},4000);
              //  setTimeout(function(){ window.location = base_url+'jobs';; },4000);
              }else{
                toastr.error(res.message, 'Alert!', {timeOut: 4000});
              }
            }
        });
        return false; // required to block normal submit since you used ajax
      },*/
       onfocusout: injectTrim($.validator.defaults.onfocusout),
      // Do not change code below
      errorPlacement : function(error, element) {
        error.insertAfter(element.parent());
      }
});
/*Add */
var data_list = $('.dataTables-example-list');
data_list.DataTable({ 
  "processing": true, //Feature control the processing indicator.
  "serverSide": true, //Feature control DataTables' servermside processing mode.
  "order": [], //Initial no order.
  "lengthChange": false,
  "oLanguage": {
  "sEmptyTable" : '<center>No Record found</center>',
  // "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>' 
},
"oLanguage": {
  "sZeroRecords" : '<center>No Record found</center>',
//  "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>' 
},
initComplete: function () {
  $('.dataTables_filter input[type="search"]').css({ 'height': '32px'});
},
// Load data for the table's content from an Ajax source
"ajax": {
  "url": base_url+$(data_list).data('list-url'),
  "type": "POST",
  "dataType": "json",
  "data": { 'id':$(data_list).data('id')},
  "headers": { 'authToken':authToken},
  "dataSrc": function (jsonData) {
    return jsonData.data;
  }
},
//Set column definition initialisation properties.
"columnDefs": [
{ orderable: false, targets: -1 },    
]
});
/******************/
function editAction(e){

    var name  = $(e).data('name');
    var id    = $(e).data('id');
    var link  = $(e).data('imagelink');
    $('#name').val(name);
    $('#instrumentId').val(id);
    $('.image_link_pre').attr("src",link);
     $('#myModal').modal('show');

}
function openAction(){
    $('#form-add').trigger("reset");
    $('#instrumentId').val(0);
    $('#name').val("");
    $('.image_link_pre').attr("src",base_url+"common_assets/img/avatars/sunny-big.png");
    $('#myModal').modal('show');
}
/******************/
      
  $(document).on('submit', "#form-add", function (event) {
    toastr.clear();
    event.preventDefault();
    var formData = new FormData(this);

        $('#submit').prop('disabled', true);
        $.ajax({
            type: "POST",
            url: base_url+$(this).attr('action'),
            headers: { 'authToken':authToken},
        
            data            : formData, //only input
        processData     : false,
        contentType     : false,
        cache           : false,
            beforeSend: function() {
              preLoadshow(true);
              $('#submit').prop('disabled', true);  
            },     
            success: function (res) {
              preLoadshow(false);
              setTimeout(function(){  $('#submit').prop('disabled', false); },4000);
              if(res.status=='success'){
                toastr.success(res.message, 'Success', {timeOut: 3000});
                setTimeout(function(){window.location.reload();},4000);
              //  setTimeout(function(){ window.location = base_url+'jobs';; },4000);
              }else{
                toastr.error(res.message, 'Alert!', {timeOut: 4000});
              }
            }
        });
/*    $.ajax({
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
    });*/
  });        //fromsubmit