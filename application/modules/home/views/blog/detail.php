<?php
    $common_assets =  base_url().'common_assets/';
    $backend_assets =  base_url().'backend_assets/';
?>
<div class="row">
    <div class="col-lg-10 col-lg-offset-1">
        <div class="ibox">
            <div class="ibox-content">
                <div class="pull-right">
                  <!--   <button class="btn btn-white btn-xs" type="button">Model</button>
                    <button class="btn btn-white btn-xs" type="button">Publishing</button>
                    <button class="btn btn-white btn-xs" type="button">Modern</button> -->
                </div>
                <div class="text-center article-title">
                <span class="text-muted"><i class="fa fa-clock-o"></i> <?= date('h:i A ,d M Y',strtotime($info['crd'])); ?></span>
                    <h1>
                       <?= $info['title'];?>
                    </h1>
                </div>
                <p>
                    <?php
                        $img = 'common_assets/img/avatars/sunny-big.png';
                    if(isset($info['image']) && !empty($info['image'])){
                        $img = 'uploads/blog/'.$info['image'];
                    }
                     if(isset($info['image']) && !empty($info['image'])){
                    ?>
                    <img src="<?= base_url().$img; ?>"  class="img img-responsive img-thunbnail image_link_pre"  />
                <?php }?>
                </p>
              
                <hr>   
                                <div class="row">
                    <div class="col-md-6">
                            <h5>Tags:</h5>
                            <button class="btn btn-primary btn-xs" type="button"><?= $instrument['name']; ?></button>
                         <!--    <button class="btn btn-white btn-xs" type="button">Publishing</button> -->
                    </div>
                    <div class="col-md-6">
                        <div class="small text-right">
                            <h5>Posted By:</h5>
                            <?php 
                                $imageL = 'common_assets/img/avatars/1.png';
                                if(!empty($userBy['profileImage'])){
                                    if($adminS==1){
                                         $imageL = 'uploads/admin/thumb/'.$userBy['profileImage'];
                                    }else{
                                         $imageL = 'uploads/users/thumb/'.$userBy['profileImage'];
                                    }
                                    
                                }
                             ?>
                            <div><img src="<?= base_url().$imageL; ?>"  class="img-sm img-rounded" >  <?= $userBy['fullName']; ?></div> 
                          <!--   <div> <i class="fa fa-comments-o"> </i> 56 comments </div> -->
                          <!--   <i class="fa fa-eye"> </i> 144 views -->
                        </div>
                    </div>
                </div>
             
                <hr>                
                <p>
                    <?= $info['description'];?>
                </p>
              
                <hr>

<!--                 <div class="row">
                    <div class="col-lg-12">

                        <h2>Comments:</h2>
                        <div class="social-feed-box">
                            <div class="social-avatar">
                                <a href="" class="pull-left">
                                    <img alt="image" src="<?= $common_assets; ?>img/a1.jpg">
                                </a>
                                <div class="media-body">
                                    <a href="#">
                                        Andrew Williams
                                    </a>
                                    <small class="text-muted">Today 4:21 pm - 12.06.2014</small>
                                </div>
                            </div>
                            <div class="social-body">
                                <p>
                                    Many desktop publishing packages and web page editors now use Lorem Ipsum as their
                                    default model text, and a search for 'lorem ipsum' will uncover many web sites still
                                    default model text.
                                </p>
                            </div>
                        </div>
                        <div class="social-feed-box">
                            <div class="social-avatar">
                                <a href="" class="pull-left">
                                    <img alt="image" src="<?= $common_assets; ?>img/a2.jpg">
                                </a>
                                <div class="media-body">
                                    <a href="#">
                                        Michael Novek
                                    </a>
                                    <small class="text-muted">Today 4:21 pm - 12.06.2014</small>
                                </div>
                            </div>
                            <div class="social-body">
                                <p>
                                    Many desktop publishing packages and web page editors now use Lorem Ipsum as their
                                    default model text, and a search for 'lorem ipsum' will uncover many web sites still
                                    default model text, and a search for 'lorem ipsum' will uncover many web sites still
                                    in their infancy. Packages and web page editors now use Lorem Ipsum as their
                                    default model text.
                                </p>
                            </div>
                        </div>
                        <div class="social-feed-box">
                            <div class="social-avatar">
                                <a href="" class="pull-left">
                                    <img alt="image" src="<?= $common_assets; ?>img/a3.jpg">
                                </a>
                                <div class="media-body">
                                    <a href="#">
                                        Alice Mediater
                                    </a>
                                    <small class="text-muted">Today 4:21 pm - 12.06.2014</small>
                                </div>
                            </div>
                            <div class="social-body">
                                <p>
                                    Many desktop publishing packages and web page editors now use Lorem Ipsum as their
                                    default model text, and a search for 'lorem ipsum' will uncover many web sites still
                                    in their infancy. Packages and web page editors now use Lorem Ipsum as their
                                    default model text.
                                </p>
                            </div>
                        </div>
                        <div class="social-feed-box">
                            <div class="social-avatar">
                                <a href="" class="pull-left">
                                    <img alt="image" src="<?= $common_assets; ?>img/a5.jpg">
                                </a>
                                <div class="media-body">
                                    <a href="#">
                                        Monica Flex
                                    </a>
                                    <small class="text-muted">Today 4:21 pm - 12.06.2014</small>
                                </div>
                            </div>
                            <div class="social-body">
                                <p>
                                    Many desktop publishing packages and web page editors now use Lorem Ipsum as their
                                    default model text, and a search for 'lorem ipsum' will uncover many web sites still
                                    in their infancy. Packages and web page editors now use Lorem Ipsum as their
                                    default model text.
                                </p>
                            </div>
                        </div>


                    </div>
                </div> -->


            </div>
        </div>
    </div>
</div>