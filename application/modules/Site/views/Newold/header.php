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
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="icon" href="assets/img/fav-icon.png" type="image/x-icon" />
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title><?php echo title; ?></title>

        <!-- Icon css link -->
        <link href="<?php echo base_url('assets/'); ?>css/font-awesome.min.css" rel="stylesheet">
        
        <!-- Bootstrap -->
        <link href="<?php echo base_url('assets/'); ?>css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Rev slider css -->
        <link href="<?php echo base_url('assets/'); ?>vendors/revolution/css/settings.css" rel="stylesheet">
        <link href="<?php echo base_url('assets/'); ?>vendors/revolution/css/layers.css" rel="stylesheet">
        <link href="<?php echo base_url('assets/'); ?>vendors/revolution/css/navigation.css" rel="stylesheet">
        <link href="<?php echo base_url('assets/'); ?>vendors/animate-css/animate.css" rel="stylesheet">
        <link href="<?php echo base_url('assets/'); ?>vendors/owl-carousel/assets/owl.carousel.min.css" rel="stylesheet">
        
        <!-- Extra plugin css -->
        <link href="<?php echo base_url('assets/'); ?>vendors/stroke-icon/style.css" rel="stylesheet">
        
        <link href="<?php echo base_url('assets/'); ?>css/style.css" rel="stylesheet">
        <link href="<?php echo base_url('assets/'); ?>css/responsive.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
       
       
        <!--================Header Area =================-->
        <header class="main_header_area color_menu">
            <div class="header_top">
                <div class="container">
                    <div class="header_top_inner">
                        <div class="pull-left">
                            <a href="#"><i class="fa fa-phone"></i>+91 <?php echo phone;?></a>
                            <a href="#"><i class="fa fa-envelope-o"></i><?php echo email;?></a>
                            <!-- <a href="#"><i class="icon icon-Timer"></i>Mon-Sat : 10 am to 7 pm</a> -->
                        </div>
                        <div class="pull-right">
                            <ul class="header_social">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header_menu">
                <nav class="navbar navbar-default">
                    <div class="container">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="#"><img src="<?php echo base_url(logo);?>" alt=""></a>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li class="active">
                                    <a href="/">Home</a>
                                </li>
                                 <li>
                                    <a href="<?php echo base_url('Site/Main/plan');?>">Plan</a>
                                </li>
                                <!-- <li>
                                    <a href="<?php //echo base_url('Site/Main/about');?>">ABout Us</a>
                                </li>
                                <li>
                                    <a href="<?php //echo base_url('Site/Main/plan');?>">Plan</a>
                                </li>
                                <li>
                                    <a href="<?php //echo base_url('Site/Main/legal');?>">Legal</a>
                                </li>
                                <li>
                                    <a href="<?php //echo base_url('Site/Main/bank');?>">Bank detail</a>
                                </li>
                                <li>
                                    <a href="<?php// echo base_url('Site/Main/Contact');?>">Contact</a>
                                </li> -->
                                <li>
                                    <a href="<?php echo base_url('Dashboard/User/Register'); ?>">Register</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('Dashboard/User/MainLogin'); ?>">Login</a>
                                </li>

                            </ul>
                           <!--  <ul class="nav navbar-nav navbar-right">
                                <li class="search_dropdown">
                                    <a href="#"><i class="icon icon-Search"></i></a>
                                    <ul class="search">
                                        <li>
                                            <form action="#" method="get" class="search-form">
                                                <div class="input-group">
                                                    <input type="search" class="form-control" placeholder="Search for">
                                                    <span class="input-group-addon">
                                                        <button type="submit"><i class="icon icon-Search"></i></button>
                                                    </span>
                                                </div>
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            </ul> -->
                        </div><!-- /.navbar-collapse -->
                    </div><!-- /.container-fluid -->
                </nav>
            </div>
        </header>
        <!--================Header Area =================-->
   