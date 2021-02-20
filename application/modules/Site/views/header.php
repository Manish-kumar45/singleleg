




<!DOCTYPE html>
<html lang="en">

<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo title; ?></title>

    <!-- Vendor CSS (Icon Font) -->
    <!-- 
<link rel="stylesheet" href="assets/css/vendor/fontawesome.min.css">
-->

    <!-- Plugins CSS (All Plugins Files) -->
    <!--
<link rel="stylesheet" href="assets/css/plugins/splitting.min.css">
<link rel="stylesheet" href="assets/css/plugins/animate.min.css">
<link rel="stylesheet" href="assets/css/plugins/jquery-ui.min.css">
<link rel="stylesheet" href="assets/css/plugins/nice-select.min.css">
<link rel="stylesheet" href="assets/css/plugins/swiper-bundle.min.css">
<link rel="stylesheet" href="assets/css/plugins/aos.min.css">
<link rel="stylesheet" href="assets/css/plugins/magnific-popup-min.css">
-->

    <!-- Main Style CSS -->
    <!-- <link rel="stylesheet" href="assets/css/style.css" />  -->


    <!-- Use the minified version files listed below for better performance and remove the files listed above -->
    <link rel="stylesheet" href="<?php echo base_url('NewSite/'); ?>assets/css/vendor/vendor.min.css">
    <link rel="stylesheet" href="<?php echo base_url('NewSite/'); ?>assets/css/plugins/plugins.min.css">
    <link rel="stylesheet" href="<?php echo base_url('NewSite/'); ?>assets/css/style.min.css">

    <style>
    @media (max-width: 479px){
        .main-header {
            min-height: 76px;
            padding: 11px 0;
        }  
    }
    </style>
</head>

<body>
    <div id="preloader">
        <div class="preloader">
            <div class="spinner-border text-primary"></div>
        </div>
    </div>

    <!-- Header Area Start Here -->
    <header class="main-header-area header-transparent header-sticky">
        <!-- Main Header Area Start -->
        <div class="main-header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-2 col-xl-2 col-md-6 col-6">
                        <div class="header-logo d-flex align-items-center">
                            <a href="">
                                <img class="nonsticky-logo img-full" src="<?php echo base_url(logo);?>" alt="Header Logo">
                                <img class="sticky-logo img-full" src="<?php echo base_url(logo);?>" alt="Header Logo">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-10 col-md-6 col-6 d-flex justify-content-end">
                        <nav class="main-nav d-none d-lg-flex">
                            <ul class="nav">
                                <li>
                                    <a class="active" href="/">
                                        <span class="menu-text"> Home</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('Site/Main/plan');?>">
                                        <span class="menu-text">Plan</span>
                                    </a>
                                </li>
                               <!--  <li>
                                    <a href="service.html">
                                        <span class="menu-text"> Service</span>
                                    </a>
                                </li> -->
                            <!--     <li>
                                    <a href="portfolio.html">
                                        <span class="menu-text"> Portfolio</span>
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="dropdown-submenu dropdown-hover">
                                        <li><a href="portfolio.html">Portfolio One</a></li>
                                        <li><a href="portfolio-2.html">Portfolio Two</a></li>
                                        <li><a href="portfolio-details.html">Portfolio Details</a></li>
                                    </ul>
                                </li> -->
                          <!--       <li>
                                    <a href="blog.html">
                                        <span class="menu-text"> Blog</span>
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="dropdown-submenu dropdown-hover">
                                        <li><a href="blog.html">Blog</a></li>
                                        <li><a href="blog-left-sidebar.html">Blog Left Sidebar</a></li>
                                        <li><a href="blog-details.html">Blog Details</a></li>
                                    </ul>
                                </li> -->
                                <li>
                                    <a href="<?php echo base_url('Site/Main/Contact');?>">
                                        <span class="menu-text">Contact</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('Dashboard/User/Register'); ?>">
                                        <span class="menu-text">Register</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('Dashboard/User/MainLogin'); ?>">
                                        <span class="menu-text">Login</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <div class="header-right-area main-nav">
                            <ul class="nav">
                                <li class="account-menu-wrap d-none d-lg-flex">
                                    <a href="#" class="off-canvas-menu-btn">
                                        <i class="fa fa-bars"></i>
                                    </a>
                                </li>
                                <li class="search-box-menu d-block d-lg-none">
                                    <a href="#" class="off-canvas-search-btn">
                                        <span class="btn-search"><i class="fa fa-search"></i></span>
                                    </a>
                                </li>
                                <li class="mobile-menu-btn d-block d-lg-none">
                                    <a class="off-canvas-btn" href="#">
                                        <i class="fa fa-bars"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main Header Area End -->
        <!-- off-canvas mobile menu start -->
        <aside class="off-canvas-wrapper" id="mobileMenu">
            <div class="off-canvas-overlay"></div>
            <div class="off-canvas-inner-content">
                <div class="btn-close-off-canvas">
                    <i class="fa fa-times"></i>
                </div>
                <div class="off-canvas-inner">
                    <div class="offcanvas-widget-area">
                        <!-- Start Serach Box -->
                        <div class="search-box-wrap off-canvas-item">
                            <form action="#" method="post">
                                <input placeholder="Search..">
                                <button class="btn-search"><i class="fa fa-search"></i>
                                </button>
                            </form>
                        </div>
                        <!-- End Search Box -->
                        <!-- mobile menu start -->
                        <div class="mobile-navigation">
                            <!-- mobile menu navigation start -->
                            <nav>
                                <ul class="mobile-menu">
                                    <li class="menu-item-has-children"><a href="/">Home</a>
                                    </li>
                                    <li><a href="<?php echo base_url('Site/Main/plan');?>">Plan</a></li>
                                    <li><a href="<?php echo base_url('Site/Main/Contact');?>">Contact</a></li>
                                      <li>
                                    <a href="<?php echo base_url('Dashboard/User/Register'); ?>">
                                        <span class="menu-text">Register</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('Dashboard/User/MainLogin'); ?>">
                                        <span class="menu-text">Login</span>
                                    </a>
                                </li>
                                </ul>
                            </nav>
                            <!-- mobile menu navigation end -->
                        </div>
                        <!-- mobile menu end -->
                        <!-- Soclial Link Start -->
                        <div class="widget-social">
                            <a title="Facebook" href="#"><i class="fa fa-facebook-f"></i></a>
                            <a title="Twitter" href="#"><i class="fa fa-twitter"></i></a>
                            <a title="Linkedin" href="#"><i class="fa fa-linkedin"></i></a>
                            <a title="Youtube" href="#"><i class="fa fa-youtube"></i></a>
                            <a title="Vimeo" href="#"><i class="fa fa-vimeo"></i></a>
                        </div>
                        <!-- Social Link End -->
                    </div>
                </div>
            </div>
        </aside>
        <!-- off-canvas menu end -->
        <!-- Offcanvas Serach Start -->
       <!--  <aside class="off-canvas-search-wrapper">
            <div class="off-canvas-overlay"></div>
            <div class="off-canvas-inner-content">
                <div class="off-canvas-inner">
                    <form action="#" method="post">
                        <input type="search" placeholder="Search..">
                        <button class="search-btn"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>
        </aside> -->
        <!-- Offcanvas Search End -->
        <!-- off-canvas menu start -->
        <aside class="off-canvas-menu-wrapper" id="sideMenu">
            <div class="off-canvas-overlay"></div>
            <div class="off-canvas-inner-content">
                <div class="off-canvas-inner">
                    <!-- offcanvas widget area start -->
                    <div class="offcanvas-widget-area">
                        <!-- Start Serach Box -->
                        <div class="search-box-wrap off-canvas-item">
                            <form action="#" method="post">
                                <input placeholder="Search..">
                                <button class="btn-search"><i class="fa fa-search"></i>
                                </button>
                            </form>
                        </div>
                        <!-- End Search Box -->
                        <ul class="menu-top-menu">
                            <li><span>Who We Are</span></li>
                        </ul>
                        <p class="desc-content">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        <ul class="useful-link">
                            <li><a href="/">Home</a></li>
                            <li><a href="<?php echo base_url('Site/Main/plan');?>">Plan</a></li>
                            <li><a href="<?php echo base_url('Site/Main/contact');?>">Contact</a></li>
                             <li>
                                    <a href="<?php echo base_url('Dashboard/User/Register'); ?>">
                                        <span class="menu-text">Register</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('Dashboard/User/MainLogin'); ?>">
                                        <span class="menu-text">Login</span>
                                    </a>
                                </li>
                        </ul>
                        <div class="widget-social">
                            <ul class="menu-top-menu">
                                <li><span>Connect With Us</span></li>
                            </ul>
                            <a title="Facebook" href="#"><i class="fa fa-facebook-f"></i></a>
                            <a title="Twitter" href="#"><i class="fa fa-twitter"></i></a>
                            <a title="Linkedin" href="#"><i class="fa fa-linkedin"></i></a>
                            <a title="Youtube" href="#"><i class="fa fa-youtube"></i></a>
                            <a title="Vimeo" href="#"><i class="fa fa-vimeo"></i></a>
                        </div>
                    </div>
                    <!-- offcanvas widget area end -->
                </div>
                <div class="btn-close-off-canvas">
                    <i class="fa fa-times"></i>
                </div>
            </div>
        </aside>
        <!-- off-canvas menu end -->
    </header>
    <!-- Header Area End Here -->
