<?php
    $common_assets =  base_url().'common_assets/';
    $backend_assets =  base_url().'backend_assets/';
    ?>
    </div>  
      <div class="footer">
            <div class="pull-right">
                1.0.0 <strong></strong> 
            </div>
            <div>
              <?php echo COPYRIGHT; ?>
                <!-- <strong>Copyright</strong> Example Company &copy; 2014-2017 -->
            </div>
        </div>

    </div>
    </div>

    <!-- Mainly scripts -->
  <!--   <script src="<?php echo $backend_assets ?>js/jquery-3.1.1.min.js"></script> -->
    <script src="<?php echo $common_assets ?>js/bootstrap.min.js"></script>
    <script src="<?php echo $common_assets ?>js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?php echo $common_assets ?>js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <!-- Toastr -->
    <script src="<?php echo $common_assets; ?>js/plugins/toastr/toastr.min.js"></script>
<!-- JQUERY VALIDATE -->
    <script src="<?php echo $common_assets; ?>js/plugins/validate/jquery.validate.min.js"></script>
    <!-- Custom and plugin javascript -->
    <script src="<?php echo $common_assets ?>js/inspinia.js"></script>
    <script src="<?php echo $common_assets ?>js/plugins/pace/pace.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.js"></script>
    <script src="<?php echo $common_assets; ?>custom/js/common.js"></script>
    <script src="<?php echo $common_assets; ?>admin/js/user.js"></script>
    <script src="<?php echo $common_assets; ?>custom/js/custom.js"></script>

  <?php if(!empty($front_scripts)) { load_js($front_scripts);} //load required page scripts ?>
  <script type="text/javascript">
      function logoutFunction() {
event.preventDefault(); // prevent form submit
var form = event.target.form; // storing the form
        swal({
  title: "Are you sure?",
  text: "You can improve your security further after logging out by closing this opened browser.",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes",
  cancelButtonText: "No",
  closeOnConfirm: false,
  closeOnCancel: false
},
function(isConfirm){
  if (isConfirm) {
    document.getElementById('confirm-logout').submit();         // submitting the form when user press yes
  } else {
    swal("Cancelled", "Your imaginary file is safe :)", "error");
  }
});
}
  </script>
</body>

</html>