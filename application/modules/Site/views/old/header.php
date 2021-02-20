<?php
if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off"){
    $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $redirect);
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Profit Venture">

<title><?php echo title; ?></title>
<link href="<?php echo base_url('NewSite/'); ?>assets/css/bootstrap.min.css" rel="stylesheet" />
<link href="<?php echo base_url('NewSite/'); ?>assets/css/fontawesome.min.css" rel="stylesheet" />
<link href="<?php echo base_url('NewSite/'); ?>assets/css/envyicon.min.css" rel="stylesheet" />
<link href="<?php echo base_url('NewSite/'); ?>assets/css/animate.min.css" rel="stylesheet" />
<link href="<?php echo base_url('NewSite/'); ?>assets/css/magnific-popup.min.css" rel="stylesheet" />
<link href="<?php echo base_url('NewSite/'); ?>assets/css/owl.carousel.min.css" rel="stylesheet" />
<link href="<?php echo base_url('NewSite/'); ?>assets/css/meanmenu.min.css" rel="stylesheet" />
<link href="<?php echo base_url('NewSite/'); ?>assets/css/style.css" rel="stylesheet" />
<link href="<?php echo base_url('NewSite/'); ?>assets/css/responsive.css" rel="stylesheet" />
<link rel="icon" href="<?php echo base_url('NewSite/'); ?>assets/img/logos/favicon.png" type="image/png" sizes="16x16">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" >
<!--  -->

</head>
<body>
<header class="navbar-area">
<div class="top-nav">
<div class="container d-flex justify-content-between">
<!-- <div class="top-left">
<ul class="info-list">
<li>
<i class="envy envy-email"></i>
<a href="#"><span class="__cf_email__" data-cfemail="3950575f56795d5654495150565a554c5b175a5654"></span></a>
</li>
<li><i class="envy envy-wall-clock"></i>Mon - Sat: 8.00 am - 7.00 pm</li>
</ul>
</div> -->	
<div class="top-right">
<div class="social-link">
<a href="#" target="_blank">
<i class="fa fa-facebook-f"></i>
</a>
<a href="#" target="_blank">
<i class="fa fa-tumblr"></i>
</a>
<a href="#" target="_blank">
<i class="fa fa-youtube"></i>
</a>
<a href="#" target="_blank">
<i class="fa fa-linkedin-in"></i>
</a>
<a href="#" target="_blank">
<i class="fa fa-instagram"></i>
</a>
</div>
</div>
</div>
</div>
<div class="mobile-nav">
<a href="#" class="logo">
<img src="<?php echo base_url(logo); ?>" alt="logo_dark" style="max-width:150px;">
<img src="<?php echo base_url(logo); ?>" alt="logo-dark" style="max-width:150px;">
</a>
</div>
<div class="main-nav">
<nav class="navbar navbar-expand-md navbar-light">
<div class="container">
<a class="navbar-brand" href="<?php echo base_url(); ?>">
<img src="<?php echo base_url(logo); ?>" alt="logo_dark" style="max-width:150px;">
<img src="<?php echo base_url(logo); ?>" alt="logo-dark" style="max-width:150px;">
</a>
<div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
<ul class="navbar-nav ml-auto">
<li class="nav-item">
<a href="index.php" class="nav-link">Home</a>
</li>
<li class="nav-item">
<a href="index.php#about_us" class="nav-link">About Us</a>
</li>
<li class="nav-item">
<a href="index.php#services" class="nav-link">Services</a>
</li>
<!-- <li class="nav-item">
<a href="<?php //echo base_url('Site/Main/Businessplan');?>" class="nav-link">Business Plan</a>
</li> -->
<!-- <li class="nav-item">
<a href="legal.php" class="nav-link">Legals</a>
</li> -->
<li class="nav-item">
<a href="index.php#contact" class="nav-link">contact</a>
</li>
<li class="nav-item cta-btn">
<a href="<?php echo base_url('Dashboard/User/MainLogin'); ?>" class="btn btn-solid">
<i class="envy envy-user"></i>
log in
</a>
</li>
<li class="nav-item cta-btn">
<a href="<?php echo base_url('Dashboard/User/Register'); ?>" class="btn btn-solid">
<i class="envy envy-user"></i>
Register
</a>
</li>
</ul>
</div>
</div>
</nav>
</div>
</header>




