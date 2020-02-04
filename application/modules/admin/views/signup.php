<div class="middle-box text-center loginscreen   animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name"><?php echo SITE_NAME; ?></h1>

            </div>
            <h3>Register to <?php echo SITE_NAME; ?></h3>
            <p>Create account to see it in action.</p>
            <form class="m-t" role="form" action="registration" id="smart-form-register">
                <div class="form-group">
                    <input class="form-control" type="text" name="fullName" placeholder="Full name" maxlength="50" size="50">
                </div>
                <div class="form-group">
                    <input class="form-control" type="email" name="email" placeholder="Email address"  maxlength="100" size="100">
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="contact" placeholder="Contact"  maxlength="100" size="100">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control"  name="password" placeholder="Password" id="password">
                </div> 
                <div class="form-group">
                    <input type="password" name="passwordConfirm" class="form-control" placeholder="Confirm password">
                </div> 
                <div class="form-group">
                   <select name="userType" class="form-control"  >
                       <option value="0">Select Type</option>
                       <option value="1">Admin</option>
                       <option value="2">School</option>
                   </select>
                </div>
              <!--   <div class="form-group">
                        <div class="checkbox i-checks"><label> <input type="checkbox"><i></i> Agree the terms and policy </label></div>
                </div> -->
                <button type="submit" id="submit" class="btn btn-primary block full-width m-b">Register</button>

                <p class="text-muted text-center"><small>Already have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="<?= base_url();?>">Login</a>
            </form>
          <!--   <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p> -->
        </div>
    </div>