<?php
        $common_assets =  base_url().'common_assets/';
        $backend_assets =  base_url().'backend_assets/';
    ?>
<div class="row animated fadeInRight">
    <div class="col-md-4">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Profile Detail</h5>
            </div>
            <div>
                <div class="ibox-content no-padding border-left-right">
                    <div class="photos text-center m-t" >
                        <img alt="<?= $user['fullName']; ?>" class="feed-photo" src="<?= $user['profileImage']; ?>">
                    </div>
                    
                </div>
                <div class="ibox-content profile-content">
                    <h4><strong><?= $user['fullName']; ?></strong></h4>
                    <p><i class="fa fa-at"></i> <?= $user['userRole']; ?></p>
                    <h5>
                        About me
                    </h5>
                    <p>
                        <?= $user['bio'] ? $user['bio']:"NA"; ?>
                    </p>
                    <div class="row m-t-lg">
                        <div class="col-md-12">
                            <h5>
                                Email
                            </h5>
                            <p>
                            <i class="fa fa-envelope"></i> <?= $user['email'] ? $user['email']:"NA"; ?>
                            </p>
                            <h5>
                                Contact Number
                            </h5>
                            <p>
                            <i class="fa fa-phone"></i> <?= $user['contactNumber'] ? $user['contactNumber']:"NA"; ?>
                            </p> 
                            <h5>
                                Class
                            </h5>
                            <p>
                            <i class="fa fa-folder-o"></i> <?= $classInfo['className'] ? $classInfo['className']:"NA"; ?>
                            </p>
                        </div>
                        
                    </div>
                   <!--  <div class="user-button">
                        <div class="row">
                            <div class="col-md-6">
                                <button type="button" class="btn btn-primary btn-sm btn-block"><i class="fa fa-envelope"></i> Send Message</button>
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-default btn-sm btn-block"><i class="fa fa-coffee"></i> Buy a coffee</button>
                            </div>
                        </div>
                    </div> -->
                </div>
        </div>
    </div>
        </div>
    <div class="col-md-8">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Activites</h5>
              <!--   <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-wrench"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#">Config option 1</a>
                        </li>
                        <li><a href="#">Config option 2</a>
                        </li>
                    </ul>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div> -->
            </div>
            <div class="ibox-content">
                <div class="row">
                      <?php if(isset($teacher) && !empty($teacher)): ?>
                    <div class="col-lg-6">
                    
               <h5>Assigned Teacher</h5>
                <div class="contact-box">
                    <a href="javascript:void(0);">
                    <div class="col-sm-4">
                        <div class="text-center">
                            <img alt="image" class="img-circle m-t-xs img-responsive" src="<?= $teacher['profileImage']; ?>">
                            <div class="m-t-xs font-bold"><?= $teacher['userRole']; ?></div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <h3><strong><?= $teacher['fullName']; ?></strong></h3>
                        <p><i class="fa fa-envelope"></i> <?= $teacher['email']; ?></p>
                        <address>
                           <!--  <strong>Twitter, Inc.</strong><br>
                            795 Folsom Ave, Suite 600<br>
                            San Francisco, CA 94107 --><br>
                            <abbr title="Phone">P:</abbr> <?= $teacher['contactNumber']; ?>
                        </address>
                    </div>
                    <div class="clearfix"></div>
                        </a>
                </div>
            
            </div>
            <?php endif; ?>
                </div>

            </div>
        </div>

    </div>
</div>