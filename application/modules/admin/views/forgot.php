
  <div class="passwordBox animated fadeInDown">
        <div class="row">

            <div class="col-md-12">
                <div class="ibox-content">

                    <h2 class="font-bold">Forgot password</h2>

                    <p>
                        Enter your email address and your password will be reset and emailed to you.
                    </p>

                    <div class="row">

                        <div class="col-lg-12">
                            <form class="m-t" role="form" action="forgotPassword" id="forgot-form">
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" maxlength="100" size="100">
                                </div>
								
                                <button type="submit" class="btn btn-primary block full-width m-b">Send new password</button>
                                <a href="<?php echo base_url(); ?>">
								<small>I remembered my password!</small>
								</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      <!--   <hr/>
        <div class="row">
            <div class="col-md-6">
                Copyright Example Company
            </div>
            <div class="col-md-6 text-right">
               <small>© 2014-2015</small>
            </div>
        </div> -->
    </div>