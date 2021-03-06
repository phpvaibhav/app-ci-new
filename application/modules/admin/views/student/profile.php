<?php
        $common_assets =  base_url().'common_assets/';
        $backend_assets =  base_url().'backend_assets/';
    ?>
<div class="row animated fadeInRight">
        <div class="col-lg-3">
            <div class="widget-head-color-box navy-bg p-lg text-center">
                <div class="m-b-md">
                <h2 class="font-bold no-margins">
                    <?= ucfirst($info['fullName']); ?>
                </h2>
                    <small class="hr-line-dashed"><!-- <?= $info['userRole']; ?> --></small>
                </div>
                <img src="<?= $info['profileImage']; ?>" class="img-circle circle-border m-b-md" alt="<?= ucfirst($info['fullName']); ?>">
                <div>
                    <span><i class="fa fa-envelope"></i> <?= $info['email'] ? $info['email']:"NA"; ?></span>
                </div>
            </div>
            <div class="widget-text-box">
                <h4 class="media-heading">Basic information</h4>
                     <ul class="list-group clear-list m-t">
                            <li class="list-group-item fist-item">
                                <span class="pull-right">
                                  <!--   09:00 pm -->
                                </span>
                               <i class="fa fa-phone"></i> <?= $info['contactNumber'] ? $info['contactNumber']:"NA"; ?>
                            </li>
                            <li class="list-group-item fist-item">
                                <a href="javascript:void(0);" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                    <i class="fa fa-plus"></i> Assign Teacher
                                </a>
                            </li> 
                        
                        </ul>
                <h4 class="media-heading">Teacher</h4>
                 <?php if(isset($teacher) && !empty($teacher)): ?>
                 <div class="widget lazur-bg">

                                <h4>
                                  <img alt="image" class="img-circle" src="<?= $teacher['profileImage']; ?>" width="40" height="40" >  <?= $teacher['fullName']; ?>
                                </h4>
                        <ul class="list-unstyled m-t-md">
                            <li>
                                <span class="fa fa-envelope m-r-xs"></span>
                                <label>:</label>
                               <?= $teacher['email']; ?>
                            </li>
                           
                            <li>
                                <span class="fa fa-phone m-r-xs"></span>
                                <label>:</label>
                                 <?= $teacher['contactNumber']; ?>
                            </li>
                        </ul>

                    </div>
                <?php else: ?>
                    <p><span class="label label-danger">NA</span></p>
                <?php endif; ?>
                <p class="hr-line-dashed"></p>
                <h4 class="media-heading">Bio</h4>
                <p> <?= $info['bio'] ? $info['bio']:"NA"; ?></p>
              
            </div>
        </div>

    <div class="col-md-9">
        <!-- Tab -->
        <div class="ibox">
            <div class="ibox-title">
                <h5>Activites</h5>
            </div>
                <div class="ibox-content">
            
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tab-1"><i class="fa fa-at"></i> Tab-1</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-2"><i class="fa fa-at"></i> Tab-2</a></li>
                </ul>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane active">
                        <center>Tab-1 Maintenance</center>
                    </div>
                    <div id="tab-2" class="tab-pane">
                         <center>Tab-2 Maintenance</center>
                    </div>
                </div>
           
            </div>
        </div>
        <!-- Tab -->

    </div>
</div>

<!-- MOdel -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content animated pulse">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Assign Teacher</h4>
            </div>
            <!-- form -->
            <form class="form-horizontal"method="post" action="adminapi/student/teacherAssign" id="form-assign-teacher" enctype="multipart/form-data" novalidate autocomplete="off">
            <div class="modal-body">
                <input type="hidden" name="studentId" value="<?= encoding($info['id']); ?>">
                <!-- form set -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="col-md-12">
                                    <label class="control-label">Teacher</label>
                                    
                                    <select class="form-control" name="teacherId">
                                        <option value=""> Select Teacher </option>
                                        <?php if(!empty($teacher_list)): foreach ($teacher_list as $t => $tvalue) { ?>
                                              <option value="<?= $tvalue->id; ?>" <?= (isset($teacher['id']) && $teacher['id']==$tvalue->id )? "seleted='selected'":""; ?>><?= $tvalue->fullName; ?> </option>
                                        <?php } endif; ?>
                                      
                                    </select>
                            </div>
                        </div>  
                    </div>

                </div>

                <!-- form set -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button type="sumbit" class="btn btn-primary">Save</button>
            </div>
            </form>
            <!-- form -->
        </div>
    </div>
</div>
<!-- MOdel -->
