<div class="loginColumns animated fadeInDown">
    <div class="row">
        <div class="col-md-6">
            <h2 class="font-bold">Welcome to <?php echo SITE_NAME; ?></h2>
            <p>
                Perfectly designed and precisely prepared admin theme with over 50 pages with extra new web app views.
            </p>
            <p>
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
            </p>
            <p>
                When an unknown printer took a galley of type and scrambled it to make a type specimen book.
            </p>
            <p>
                <small>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</small>
            </p>
        </div>
        <div class="col-md-6">
            <div class="ibox-content">
                <form class="m-t" role="form" method="POST" action="login" id="login-form">
                    <div class="form-group">
                        <input  class="form-control" type="text" id="username" name="email" maxlength="100" size="100" placeholder="Email or user name">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password" id="password">
                    </div>
                    <div class="form-group">
                        <div class="checkbox i-checks"><label><input type="checkbox" id="remember_me" name="remember"><i></i> Stay signed in </label></div>
                </div>
                    <button type="submit" class="btn btn-primary block full-width m-b" id="submit" >Login</button>

                    <a href="<?php echo base_url().'home/forgot' ?>">
                        <small>Forgot password?</small>
                    </a>

                    <p class="text-muted text-center">
                        <small>Do not have an account?</small>
                    </p>
                    <a class="btn btn-sm btn-white btn-block" href="<?= base_url().'home/signup';?>">Create an account</a>
                </form>
                <p class="m-t">
                    <small><?php echo SITE_NAME; ?> &copy; <?= date('Y')?></small>
                </p>
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