<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo SITE_NAME.' | Admin' ?></title>
    <?php
        $common_assets =  base_url().'common_assets/';
        $backend_assets =  base_url().'backend_assets/';
    ?>
     <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $common_assets; ?>img/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $common_assets; ?>img/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $common_assets; ?>img/favicon/favicon-16x16.png">
        <link rel="manifest" href="<?php echo $common_assets; ?>img/favicon/site.webmanifest">
    <!-- Favicon -->
    <link href="<?php echo $common_assets; ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $common_assets; ?>font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo $common_assets; ?>css/animate.css" rel="stylesheet">
    <!-- Toastr style -->
    <link href="<?php echo $common_assets; ?>css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <link href="<?php echo $common_assets; ?>css/style.css" rel="stylesheet">
    <!-- sweetalert -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
    <?php if(!empty($front_styles)) { load_css($front_styles); } //load required page styles 
     ?>
    <!-- custom -->
    <link rel="stylesheet" type="text/css" href="<?php echo $common_assets; ?>custom/css/custom.css">
    <!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body class=""  data-base-url="<?php echo base_url(); ?>" data-auth-url="<?php echo $user['authToken']; ?>">
<!-- loader -->
<div class="dialog-background" id="pre-load-dailog" style="display: none;">
    <div class="dialog-loading-wrapper">
        <span class="dialog-loading-icon"><img src="<?php echo $common_assets; ?>/img/ajax-loader.gif" alt="Loading..."></span>
    </div>
</div> 
<!-- loader -->
    <div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
             <div class="logo-element-logo">
              <a href="<?= base_url().'dashboard';?>"> <img src="<?php echo base_url().'common_assets/img/meteor_logo.png'; ?>" class="m-t" width="200" height="50" alt=""></a>
            </div>
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <img alt="<?php echo $user['fullName']? $user['fullName'] :''; ?>" class="img-circle" height="48" width="48" src="<?php echo $user['profileImage']? $user['profileImage'] :base_url().'common_assets/img/avatars/sunny.png'; ?>"   />
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $user['fullName']? ucfirst($user['fullName']) :''; ?></strong>
                             </span> <span class="text-muted text-xs block"><?php echo $user['userRole']? ucfirst($user['userRole']) :''; ?><b class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="<?php echo base_url().'profile/'.encoding($user['userId']);  ?>">Profile</a></li>
                            <li><a href="<?php echo base_url().'change_password/'.encoding($user['userId']);  ?>">Change Password</a></li>
                    
                             
                            <li class="divider"></li>
                            <li><a href="javascript:void(0);" onclick="logoutFunction();">Logout</a>
                            <form id="confirm-logout" action="<?php echo base_url().'admin/logout'; ?>" method="POST" style="display: none;">

                            </form>
                            </li>
                        </ul>
                    </div>
                    <div class="logo-element">
                         <?php //Use mb_substr to get the first character.
                            $firstChar = mb_substr(SITE_NAME,0,1, "UTF-8");
                            echo $firstChar ;
                         ?>
                    </div>
                </li>
                <li>
                    <a href="<?= base_url().'dashboard';?>" class="<?php echo (strtolower($this->router->fetch_class()) == 'dashboard') ? 'active' : '' ?>"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
                </li>
                <li>
                    <a href="<?= base_url().'institute-all';?>" class="<?php echo (strtolower($this->router->fetch_class()) == 'institute-all') ? 'active' : '' ?>"><i class="fa fa-graduation-cap"></i> <span class="nav-label">Institutes</span></a>
                </li>
                <li>
                    <a href="<?= base_url().'teacher-all';?>" class="<?php echo (strtolower($this->router->fetch_class()) == 'teacher-all') ? 'active' : '' ?>"><i class="fa fa-vcard"></i> <span class="nav-label">Teachers</span></a>
                </li>
                 <li>
                    <a href="<?= base_url().'student-all';?>" class="<?php echo (strtolower($this->router->fetch_class()) == 'student-all') ? 'active' : '' ?>"><i class="fa fa-child"></i> <span class="nav-label">Students</span></a>
                </li>
            </ul>

        </div>
    </nav>

        <div id="page-wrapper" class="gray-bg">

        <div class="row border-bottom">
        <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
         <!--    <form role="search" class="navbar-form-custom" action="search_results.html">
                <div class="form-group">
                    <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                </div>
            </form> -->
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <!-- <li>
                    <span class="m-r-sm text-muted welcome-message">Welcome to INSPINIA+ Admin Theme.</span>
                </li> -->
<!--                 <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope"></i>  <span class="label label-warning">16</span>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="img/a7.jpg">
                                </a>
                                <div class="media-body">
                                    <small class="pull-right">46h ago</small>
                                    <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>. <br>
                                    <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="img/a4.jpg">
                                </a>
                                <div class="media-body ">
                                    <small class="pull-right text-navy">5h ago</small>
                                    <strong>Chris Johnatan Overtunk</strong> started following <strong>Monica Smith</strong>. <br>
                                    <small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="img/profile.jpg">
                                </a>
                                <div class="media-body ">
                                    <small class="pull-right">23h ago</small>
                                    <strong>Monica Smith</strong> love <strong>Kim Smith</strong>. <br>
                                    <small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="mailbox.html">
                                    <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li> -->
<!--                 <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i>  <span class="label label-primary">8</span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="mailbox.html">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="profile.html">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="grid_options.html">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="notifications.html">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li> -->


                <li>
                    <a href="javascript:void(0);" onclick="logoutFunction();">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
            </ul>

        </nav>
    </div>
    <?php if(isset($breadcrumb) && !empty($breadcrumb)): ?>
    <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h2><?= $title; ?></h2>
                    <ol class="breadcrumb">
                         <?php
                           foreach ($breadcrumb as $key=>$value) {
                            if($value!=''){
                           ?>
                        <li>
                            <a href="<?=$value; ?>"><?=$key; ?></a>
                        </li>
                        <?php }else{ ?>
                        <li class="active">
                            <strong><?=$key; ?></strong>
                        </li>
                         <?php }
                           }
                           ?>     
                    </ol>
                </div>
                <div class="col-sm-8">
                    <div class="title-action">
                       <!--  <a href="" class="btn btn-primary">This is action area</a> -->
                    </div>
                </div>
            </div>
    <?php endif ?>
            <div class="wrapper wrapper-content animated fadeInRight">