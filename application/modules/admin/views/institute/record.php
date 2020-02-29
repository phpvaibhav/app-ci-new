<?php $common_assets= base_url().'common_assets/';?>
 <?php 
$colors = array('bg-muted', 'bg-primary','bg-success','bg-info','bg-warning','bg-danger');

 if(!empty($result)): foreach($result as $k => $user) {  $rand_color = $colors[array_rand($colors)]; ?>
    

                                        <div class="col-lg-4 ">
                                            <div class="contact-box center-version ">
                                                <!-- teacher-detail -->
                                                <?php
                                                    $actionurl = "javascript:void(0);"; 
                                                    switch ($user->roleId) {
                                                        case 2:
                                                           $actionurl = base_url().'teacher-detail/'.encoding($user->id); 
                                                            break;
                                                        
                                                        default:
                                                             $actionurl = "javascript:void(0);"; 
                                                            break;
                                                    }

                                                ?>
                                                <a href="<?= $actionurl; ?>">

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
                                                     
                                                    </address>

                                                </a>
                                                <div class="contact-box-footer">
                                                    <ul class="list-unstyled file-list">
                                                        <li><a href="javascript:void(0);"><i class="fa fa-envelope"></i> <?= $user->email; ?></a></li>
                                                         <li><a href="javascript:void(0);"><i class="fa fa-phone"></i> <?= $user->contactNumber; ?></a></li>

                                                    </ul>
                                                 
                                                </div>

                                            </div>
                                        </div>
                                        <?php } endif; ?> 