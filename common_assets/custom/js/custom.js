//number check 
$('.number-only').keypress(function(e) {
  if(isNaN(this.value+""+String.fromCharCode(e.charCode))) return false;
}).on("cut copy paste",function(e){
  e.preventDefault();
});
$(".floatNumeric").on("keypress keyup blur",function (event) {
  //this.value = this.value.replace(/[^0-9\.]/g,'');
  $(this).val($(this).val().replace(/[^0-9\.]/g,''));
  if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
    event.preventDefault();
  }
});
$(".alfaNumeric").on("keypress keyup blur",function (event) {
  if (this.value.match(/[^a-zA-Z0-9 ]/g)) {
    this.value = this.value.replace(/[^a-zA-Z0-9 ]/g, '');
  }
});

function filePreview(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
    /*   $('#uploadForm + img').remove();
    $('#uploadForm').after('<img src="'+e.target.result+'" width="450" height="300"/>');*/
    $('#privew + embed').remove();
    $('#privew + img').remove();
    $('#privew').after('');
    $('#privew').after('<embed src="'+e.target.result+'" width="250" height="250">');
  }
  reader.readAsDataURL(input.files[0]);
  }
}
function filePreviewImage(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
    /*   $('#uploadForm + img').remove();
    $('#uploadForm').after('<img src="'+e.target.result+'" width="450" height="300"/>');*/
    $('#privew + embed').remove();
    $('#privew + img').remove();
    $('#privew').after('');
    $('#privew').html('<img src="'+e.target.result+'" class="img img-responsive img-thunbnail"/>');
  }
  reader.readAsDataURL(input.files[0]);
  }
}