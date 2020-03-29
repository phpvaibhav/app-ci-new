<?php
    $common_assets =  base_url().'common_assets/';
    $backend_assets =  base_url().'backend_assets/';
?>
<div class="row">
    <div class="col-lg-10 col-lg-offset-1">
        <div class="ibox">
            <div class="ibox-content">
                <div class="pull-right">
                    <?php if($info['resolved']):?>
                          <button class="btn btn-success btn-xs" type="button">Resolved</button>
                  
                    <?php else: ?>
                      <button class="btn btn-danger btn-xs" type="button">Pending</button>
                    <?php endif; ?>
                     <button class="btn btn-warning btn-xs" type="button">  #<?= $info['ticketNumber']; ?></button>
                </div>
                <div class="text-center article-title">
                <span class="text-muted"><i class="fa fa-clock-o"></i> <?= date('d-m-Y',strtotime($info['crd'])); ?></span>
                    <h1>
                       <?= $info['title']; ?>
                    </h1>
                </div>
                <p>
                    <?= $info['message']; ?>
                </p>
             
              
                <hr>
                <div class="row">
                    <div class="col-md-6">
                            <h5>Action:</h5>
                            <?php if(!$info['resolved']): ?>
                                <a href="javascript:void(0)" onclick="confirmAction(this);" data-message="You want to change resolve ticket!" data-id="<?= encoding($info['supportId']); ?>" data-url="adminapi/support/supportStatus" data-list="1"  class="on-default edit-row table_action" title="Resolve"><i class="fa fa-check" aria-hidden="true"></i></a>&nbsp;&nbsp;|&nbsp;&nbsp;
                            <?php endif; ?>
                            <a href="javascript:void(0);" onclick="confirmAction(this);" data-message="You want to delete this record!" data-id="<?= encoding($info['supportId']); ?>" data-url="adminapi/support/supportDelete" data-list="1"  class="on-default edit-row table_action" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                       <!--      <button class="btn btn-primary btn-xs" type="button">Model</button> -->
                          <!--   <button class="btn btn-white btn-xs" type="button">Publishing</button> -->
                    </div>
                    <div class="col-md-6">
                        <div class="small text-right">
                            <h5>Stats:</h5>
                         <!--    <div> <i class="fa fa-comments-o"> </i> 56 comments </div> -->
                            <i class="fa fa-eye text-success"> </i> 
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">

                        <h2>Comments:</h2>
                  <!--     <?php
                      echo "<pre>";
                      print_r($replies);
                      echo "</pre>";

                      ?> -->
                        <?php if(!empty($replies)): foreach ($replies as $k => $reply) {
                           ?>
                        <div class="social-feed-box">
                            <div class="social-avatar">
                                <a href="" class="pull-left">
                                    <img alt="image" src="<?= $reply->userinfo['profileImage']; ?>">
                                </a>
                                <div class="media-body">
                                    <a href="javascript:void();">
                                       <?= $reply->userinfo['fullName']; ?>
                                    </a>
                                    <small class="text-muted"> <?=  date(' d.m.Y - h:i A',strtotime($reply->crd)); ?></small>
                                </div>
                            </div>
                            <div class="social-body">
                                <p>
                                   
                                    <?=  $reply->message; ?>
                                </p>
                            </div>
                        </div>
                    <?php } endif; ?>
                         <hr> 
                        <div class="">
                           <form class="form-horizontal"method="post" action="adminapi/support/supportReply" id="form-support-reply" enctype="multipart/form-data" novalidate autocomplete="off">
                               <div class="form-group row">
                            <div class="col-md-12">
                                <label class="control-label">Reply (#<?= $info['ticketNumber']; ?>)</label>
                                 <textarea name="message" class="form-control" class=""></textarea>
                            </div> 
                            <hr> 
                            <div class="col-md-12">
                                <input type="hidden" name="userType" value="0">
                                <input type="hidden" name="supportId" value="<?= encoding($info['supportId']); ?>">
                                <br>
                                <br>
                                <button type="sumbit" class="btn btn-primary">Reply</button>
                            </div>
                        </div>  
                           </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>