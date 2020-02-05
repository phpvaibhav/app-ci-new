<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo SITE_NAME.' | '.$title; ?></title>
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
    <link href="<?php echo $common_assets; ?>css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="<?php echo $common_assets; ?>css/animate.css" rel="stylesheet">
    <!-- Toastr style -->
    <link href="<?php echo $common_assets; ?>css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <link href="<?php echo $common_assets; ?>css/style.css" rel="stylesheet">
     <?php if(!empty($front_styles)) { load_css($front_styles); } //load required page styles 
     ?>
    <!-- custom -->
    <link rel="stylesheet" type="text/css" href="<?php echo $common_assets; ?>custom/css/custom.css">
</head>

<body class="gray-bg" data-base-url="<?php echo base_url(); ?>">
<!-- loader -->
<div class="dialog-background" id="pre-load-dailog" style="display: none;">
    <div class="dialog-loading-wrapper">
        <span class="dialog-loading-icon"><img src="<?= base_url();?>common_assets/img/ajax-loader.gif" alt="Loading..."></span>
    </div>
</div> 
<!-- loader -->