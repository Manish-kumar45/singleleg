<!DOCTYPE html>
<!--
   This is a starter template page. Use this page to start your new project from
   scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title><?php echo title; ?></title>
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="<?php echo base_url('assets/') ?>plugins/fontawesome-free/css/all.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url('assets/') ?>dist/css/adminlte.min.css">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo base_url('assets/') ?>plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    </head>
    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="<?php echo base_url('Admin'); ?>" class="nav-link">Home</a>
                    </li>
                    <!-- <li class="nav-item d-none d-sm-inline-block">
                       <a href="#" class="nav-link">Contact</a>
                    </li> -->
                </ul>
            </nav>
            <!-- /.navbar -->
            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="<?php echo base_url('Admin/Management/'); ?>" class="brand-link" style="">
                    <img src="<?php echo base_url(logo2) ?>" alt="Logo" class="brand-image img-circle elevation-3"
                         style="opacity: 1">
                    <span class="brand-text font-weight-light"><?php echo title; ?> Admin</span>
                </a>
                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                       <div class="image">
                          <img src="<?php echo base_url('uploads/winto_logo.jpg') ?>" class="img-circle elevation-2" alt="User Image">
                       </div>
                       <div class="info">
                          <a href="#" class="d-block">Winto</a>
                       </div>
                    </div> -->
                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class
                               with font-awesome or any other icon font library -->
                            <li class="nav-item has-treeview menu-open">
                                <a href="<?php echo base_url('Admin/Management/Index'); ?>" class="nav-link">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-chart-pie"></i>
                                    <p>
                                        Settings
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="display: none;">
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('Admin/Settings/news'); ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>News</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('Admin/Management/popup_upload'); ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Upload Popup Image</p>
                                        </a>
                                    </li>
                                    <li class="nav-item d-none">
                                        <a href="<?php echo base_url('Admin/Franchise'); ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Franchise</p>
                                        </a>
                                    </li>
                                    <li class="nav-item d-none">
                                        <a href="<?php echo base_url('Admin/Achievers'); ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Achievers</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('Admin/Settings/updatePassword'); ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Password Manager</p>
                                        </a>
                                    </li>
                                    <!-- <li class="nav-item">
                                        <a href="<?php //echo base_url('Dashboard/User/register_cron'); ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Register New Accounts</p>
                                        </a>
                                    </li> -->
                                </ul>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-chart-pie"></i>
                                    <p>
                                        Income Reports
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="display: none;">
                                    <?php
                                    $incomes = incomes();
                                    foreach ($incomes as $key => $income) {
                                        echo'<li class="nav-item">
                                    <a href="' . base_url('Admin/Withdraw/income/' . $key) . '" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>' . $income . '</p>
                                    </a>
                                 </li>';
                                    }
                                    ?>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('Admin/Withdraw/incomeLedgar/'); ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Income Ledgar</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('Admin/Settings/payout_summary/'); ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Payout Summary</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('Admin/Settings/income_management/'); ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Income Management</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('Admin/Withdraw/income/pin_generation'); ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Pin Generation</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-chart-pie"></i>
                                    <p>
                                        Epins Management
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="display: none;">
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('Admin/Settings/Epins/0'); ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Available Pins</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('Admin/Settings/Epins/1'); ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Used Pins</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('Admin/Settings/Epins/2'); ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Transferred Pins</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('Admin/Settings/CreateEpins'); ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Generate Epins</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('Admin/Settings/UsersEPins'); ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Epins History</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('Admin/Settings/UnusedEpins'); ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Unused Epins</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-chart-pie"></i>
                                    <p>
                                        Notifications
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="display: none;">
                                    <li class="nav-item">
                                        <a href="<?php // echo base_url('Admin/Management/BankTransactions'); ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Bank Transactions</p>
                                        </a>
                                    </li>
                                </ul>
                            </li> -->
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-chart-pie"></i>
                                    <p>
                                        Users Detaills
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="display: none;">

                                    <li class="nav-item">
                                        <a href="<?php echo base_url('Admin/Management/users'); ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>All Members</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('Admin/Management/royaltyUser'); ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Royalty Members</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('Admin/Management/goldroyaltyUser'); ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Gold Royalty Members</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('Admin/Management/leadershipUser'); ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Leadership Members</p>
                                        </a>
                                    </li>
                                   <!--  <li class="nav-item">
                                        <a href="<?php //echo base_url('Admin/Management/higher_level_members'); ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Higher Level Members</p>
                                        </a>
                                    </li> -->
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('Admin/Management/today_joinings'); ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>View Today Joinings</p>
                                        </a>
                                    </li>
                                    <!-- <li class="nav-item">
                                        <a href="<?php echo base_url('Admin/Management/available_ewallet'); ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Users E-wallet Fund</p>
                                        </a>
                                    </li> -->
                                    <!-- <li class="nav-item">
                                        <a href="<?php //echo base_url('Admin/Management/available_income_wallet'); ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Users Income Wallet Fund</p>
                                        </a>
                                    </li> -->
                                    <!-- <li class="nav-item">
                                        <a href="<?php //echo base_url('Admin/Management/available_higher_income_wallet'); ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Users Income Wallet Fund 500+</p>
                                        </a>
                                    </li> -->
                                    <!-- <li class="nav-item">
                                        <a href="<?php //echo base_url('Admin/Management/retopup_users'); ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Retopup Users</p>
                                        </a>
                                    </li> -->
                                </ul>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-chart-pie"></i>
                                    <p>
                                        Roi Details
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="display: none;">

                                    <li class="nav-item">
                                        <a href="<?php echo base_url('Admin/Task/Roi/single_leg'); ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Single Leg ROI</p>
                                        </a>
                                    </li>
                                   <!--  <li class="nav-item">
                                        <a href="<?php //echo base_url('Admin/Task/Roi/booster_income'); ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Booster ROI</p>
                                        </a>
                                    </li> -->
                                </ul>
                            </li>
                            <!-- <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-chart-pie"></i>
                                    <p>
                                        KYC
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="display: none;">
                                    <li class="nav-item">
                                        <a href="<?php //echo base_url('Admin/Withdraw/AddressRequests') ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Kyc Requests</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php //echo base_url('Admin/Withdraw/ApprovedAddressRequests') ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Approved Kyc Request List</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php// echo base_url('Admin/Withdraw/RejectedAddressRequests') ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Rejected Kyc Request List</p>
                                        </a>
                                    </li>
                                </ul>
                            </li> -->
                            <li class="nav-item has-treeview" style="display:none;">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-chart-pie"></i>
                                    <p>
                                        Fund Management
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="display: none;">
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('Admin/Management/Fund_requests/'); ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Fund Request List</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('Admin/Management/Fund_requests/1'); ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Approved Fund Request List</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('Admin/Management/Fund_requests/0'); ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Pending Fund Request List</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('Admin/Management/Fund_requests/2'); ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Rejected Fund Request List</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('Admin/Management/fund_history'); ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Fund History</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('Admin/Management/user_generated_fund'); ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>User Generated Fund</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('Admin/Management/SendWallet'); ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Send Fund Personally</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-chart-pie"></i>
                                    <p>
                                        Support
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="display: none;">
                                    <!-- <li class="nav-item">
                                        <a href="<?php //echo base_url('Admin/Support/inbox'); ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Panding Tickets</p>
                                        </a>
                                    </li> -->
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('Admin/Support/Compose'); ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Create Ticket</p>
                                        </a>
                                    </li>
                                   <li class="nav-item">
                                        <a href="<?php echo base_url('Admin/Support/Outbox'); ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Ticket History</p>
                                        </a>
                                    </li> 
                                </ul>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-chart-pie"></i>
                                    <p>
                                        Withdraw Management
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="display: none;">
                                    <!-- <li class="nav-item">
                                        <a href="<?php echo base_url('Admin/Withdraw') ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>All Withdraw Request</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('Admin/Withdraw/Pending') ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Pending Withdraw Request</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('Admin/Withdraw/excelList') ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Bank Excel Download</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('Admin/Withdraw/Approved') ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Approved Withdraw Request</p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="<?php echo base_url('Admin/Withdraw/Rejected') ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Rejected Withdraw Request</p>
                                        </a>
                                    </li> -->
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('Admin/Management/BankTransactions'); ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Bank Transactions</p>
                                        </a>
                                    </li>
                                    <!-- <li class="nav-item">
                                        <a href="<?php //echo base_url('Admin/Settings/sendIncome'); ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Return Income</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php //echo base_url('Admin/Settings/sendIncomeHistory'); ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Return Income History</p>
                                        </a>
                                    </li> -->
                                </ul>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="<?php echo base_url('Admin/Management/logout'); ?>" class="nav-link">
                                    <i class="nav-icon fas fa-chart-pie"></i>
                                    <p>Logout
                                    </p>
                                </a>

                            </li>
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>
