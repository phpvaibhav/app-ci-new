<div class="loginColumns animated fadeInDown">
    <div class="row">
        <div class="col-md-12">
            <h3 class="font-bold text-center">Welcome to <?php echo SITE_NAME; ?></h3>
        </div>
        <div class="col-md-12">
            <div class="ibox-content">
                <form class="form-horizontal" method="post" action="registration" id="form-register-front" enctype="multipart/form-data" novalidate autocomplete="off">
                    <!-- form set -->
                    <div class="form-group">
                        <div class="col-md-12">
                                <label class="control-label">Institute Name</label>
                                <input type="text" name="name" placeholder="Institute Name" id="name" value="" class="form-control" >
                        </div>
                       
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                                <label class="control-label">First Name</label>
                                <input type="text" name="firstName" placeholder="First Name" id="firstName" value="" class="form-control" >
                        </div>
                        <div class="col-md-6">
                                <label class="control-label">Last Name</label>
                                <input type="text" name="lastName" placeholder="Last Name" id="lastName" value="" class="form-control" >
                        </div>
                    </div>
                      
                    <div class="form-group">
                        <div class="col-md-6">
                            <label class="control-label">Email</label>
                            <input type="email" name="email" placeholder="Email" id="email" value="" class="form-control" >
                        </div>
                        <div class="col-md-6">
                            <label class="control-label">Contact</label>
                            <input type="text" name="contact" placeholder="Contact number" id="contact" value="" class="form-control" >
                        </div>
                    </div>  
                    <div class="form-group">
                        <div class="col-md-6">
                            <label class="control-label">Password</label>
                            <input type="password" name="password" placeholder="Password" id="password" value="" class="form-control" >
                        </div>
                        <div class="col-md-6">
                            <label class="control-label">Confirm Password</label>
                            <input type="password" name="c_password" placeholder="Confirm Password" id="c_password" value="" class="form-control" >
                        </div>
                    </div>  
                    <!-- form set -->
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3 m-t">
                        <button type="submit" class="btn btn-primary block full-width m-b" id="submit" >Register</button>
                        </div>
                    </div>    
                </form>
             <!--    <p class="m-t">
                    <small><?php echo SITE_NAME; ?> &copy; <?= date('Y')?></small>
                </p> -->
            </div>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-md-6">
            <?php echo SITE_NAME; ?>
        </div>
        <div class="col-md-6 text-right">
           <small>© <?= date('Y')?></small>
        </div>
    </div>
</div>