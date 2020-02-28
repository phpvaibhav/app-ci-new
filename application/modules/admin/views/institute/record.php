<?php $common_assets= base_url().'common_assets/';?>
 <?php 
$colors = array('bg-muted', 'bg-primary','bg-success','bg-info','bg-warning','bg-danger');

 if(!empty($result)): foreach($result as $k => $user) {  $rand_color = $colors[array_rand($colors)]; ?>
    

                                        <div class="col-lg-4 ">
                                            <div class="contact-box center-version ">

                                                <a href="javascript:void(0);">

                                                    <img alt="image" class="img-circle" src="<?= base_url().$user->profileImage;?>">


                                                    <h3 class="m-b-xs"><strong><?= $user->fullName; ?></strong></h3>

                                                    <div class="font-bold"><?= $user->email; ?></div>
                                                    <address class="m-t-md">
                                                        <strong>Approval :</strong>
                                                        <?= $user->joinShow; ?><br> 
                                                        <?php if(isset($user->classId)): ?>
                                                        <strong>Class  :</strong>
                                                        <?= student_class_name($user->classId); ?><br>
                                                    <?php endif; ?>
                                                       <br>
                                                        <abbr title="Phone">P:</abbr> <?= $user->contactNumber; ?>
                                                    </address>

                                                </a>
                                                <div class="contact-box-footer">
                                                    <div class="m-t-xs btn-group">
                                                        <?= substr($user->bio, 0, 5)."..."; ?>
                                                     <!--    <a class="btn btn-xs btn-white"><i class="fa fa-phone"></i> Call </a>
                                                        <a class="btn btn-xs btn-white"><i class="fa fa-envelope"></i> Email</a>
                                                        <a class="btn btn-xs btn-white"><i class="fa fa-user-plus"></i> Follow</a> -->
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <?php } endif; ?> 