<?php 
 $common_assets =  base_url().'common_assets/';
$backend_assets =  base_url().'backend_assets/';

 ?>
 <!-- Mainly scripts -->
    <script src="<?php echo $common_assets; ?>js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo $common_assets; ?>js/bootstrap.min.js"></script>
   <!-- Toastr -->
    <script src="<?php echo $common_assets; ?>js/plugins/toastr/toastr.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo $common_assets; ?>js/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>
        <!-- JQUERY VALIDATE -->
    <script src="<?php echo $common_assets; ?>js/plugins/validate/jquery.validate.min.js"></script>
    <script src="<?php echo $common_assets; ?>custom/js/common.js"></script>
    <script src="<?php echo $common_assets; ?>admin/js/login.js"></script>
    <script src="<?php echo $common_assets; ?>custom/js/custom.js"></script>
  </body>
</html>
