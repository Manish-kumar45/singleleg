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
        <link rel="stylesheet" href="<?php echo base_url('assets/') ?>dist/css/custom.css">
        <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->
        <link rel="stylesheet" href="<?php echo base_url('assets/') ?>plugins/datatables-bs4/css/dataTables.bootstrap4.css">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
        <style>
            [class*=sidebar-light-] {
                background:linear-gradient(0deg,#0098f0,#00f2c3);
                color: #fff;
            }
            [class*=sidebar-light-] .sidebar a {
                color: #000;
                font-size: 16px;
                font-family: 'Roboto', sans-serif;
            }
            [class*=sidebar-light-] .nav-sidebar>.nav-item.menu-open>.nav-link, [class*=sidebar-light-] .nav-sidebar>.nav-item:hover>.nav-link {
                    background:linear-gradient(135deg, #ffc480, #ff763b);
                    color: #fff;
                    box-shadow: 0 4px 20px 0 rgba(0,0,0,.14), 0 7px 10px -5px rgba(74, 92, 242, 0.6);
            }
            ul.nav.nav-treeview li {
                margin-left: 7px;
            }
            ul.nav.nav-treeview i {
                left: 7px;
            }
            .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link.active, .sidebar-light-primary .nav-sidebar > .nav-item > .nav-link.active {
                background:linear-gradient(135deg, #ffc480, #ff763b);
                color: #fff;
                border:0;
                box-shadow: 0 4px 20px 0 rgba(0,0,0,.14), 0 7px 10px -5px rgba(74, 92, 242, 0.6);
            }
            [class*=sidebar-light-] .nav-sidebar>.nav-item>.nav-treeview {
                background: transparent !important;
                border-left: 4px #e667ba solid;
            }
            .nav-sidebar>.nav-item {
                margin-bottom: 0;
                border-top: 1px #000 solid;
            }
            [class*=sidebar-light-] .nav-sidebar>.nav-item>.nav-treeview {
                background: #3f9e8f;
                color: #fff;
            }
            [class*=sidebar-light-] .nav-treeview>.nav-item>.nav-link {
                color: #000;
            }
            .nav-pills .nav-link:not(.active):hover {
                color: #fff;
            }
            .nav-sidebar > .nav-item .nav-icon {
                color: #000;
            }
            [class*=sidebar-light] .brand-link {

                background: white;
            }
            .navbar-white {
                background-color: #fff !important;
            }
            .main-header .nav-link {
                height: 2.5rem;
                position: relative;
                position: absolute;
                right: 10px;
                font-size: 27px;
                margin-top: -7px;
            }
            div#tableView_wrapper {
                max-width: 100%;
                overflow: scroll;
            }
            .nav-sidebar .nav-link p {
                display: inline-block;
                margin: 0;
                margin-left: 5px;
            }
        </style>
    </head>
    <body class="hold-transition sidebar-mini">
        <?php
        $user_info = userinfo();
        ?>
        <div class="wrapper">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <a class="nav-link menu-toggler" data-widget="pushmenu"  href="#"><i class="fas fa-bars"></i></a>
                <img src="<?php echo base_url(logo) ?>" alt="Winto Logo" class="brand-image"
                     style="max-width: 130px;">

            </nav>
            <!-- /.navbar -->
            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-light-primary elevation-1">
                <!-- Brand Logo -->
                <a href="<?php echo base_url('Dashboard'); ?>" class="brand-link">
                    <img src="<?php echo base_url(logo) ?>" alt="Winto Logo" class="brand-image"
                         style="opacity: .8; max-width: 90px;">
                    <span class="brand-text font-weight-light"><?php echo $user_info->user_id; ?></span>
                </a>
                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                       <div class="image" style="background-color:#000;">
                          <img src="<?php //echo base_url(logo) ?>" class="img-circle elevation-1" alt="User Image">
                       </div>
                       <div class="info">
                          <a href="<?php// base_url('Dashboard/User'); ?>" class="d-block">Dashboard</a>
                       </div>
                    </div> -->
                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class
                               with font-awesome or any other icon font library -->
                            <li class="nav-item has-treeview">
                                <a href="<?php echo base_url('Dashboard/User/'); ?>" class="nav-link active">
                                    <i class="fas fa-home"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                   <i class="fas fa-layer-group"></i>
                                    <p>
                                        Downline Report
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="display: none;">
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('Dashboard/User/Tree/' . $user_info->user_id); ?>" class="nav-link">
                                            <i class="right fas fa-angle-right"></i>
                                            <p>Tree View</p>
                                        </a>
                                    </li>
                                    <!-- <li class="nav-item">
                                       <a href="<?php //echo base_url('Dashboard/User/Downline'); ?>" class="nav-link">
                                          <i class="right fas fa-angle-right"></i>
                                          <p>Downline List</p>
                                       </a>
                                    </li> -->
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('Dashboard/User/Directs'); ?>" class="nav-link">
                                            <i class="right fas fa-angle-right"></i>
                                            <p>My Direct</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('Dashboard/User/LeaderShipTeamDetail'); ?>" class="nav-link">
                                            <i class="right fas fa-angle-right"></i>
                                            <p>LeaderShip Team Details</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('Dashboard/User/Genelogy'); ?>" class="nav-link">
                                            <i class="right fas fa-angle-right"></i>
                                            <p>Genelogy View</p>
                                        </a>
                                    </li>
                                    <?php
                                    if ($user_info->single_leg_status >= 5) {
                                        echo'<li class="nav-item">
                                                <a href="' . base_url('Dashboard/User/Pool/' . $user_info->user_id) . '" class="nav-link">
                                                <i class="right fas fa-angle-right"></i>
                                                <p>Auto Pool Tree</p>
                                                </a>
                                            </li>';
                                    }
                                    //         $pool_count = pool_count();
                                    //         for ($i = 1; $i <= $pool_count->pool_count; $i++) {
                                    //             echo'<li class="nav-item">
                                    //      <a href="' . base_url('Dashboard/User/Pool/' . $user_info->user_id . '/' . $i) . '" class="nav-link">
                                    //         <i class="right fas fa-angle-right"></i>
                                    //         <p>Pool ' . $i . '</p>
                                    //      </a>
                                    //   </li>';
                                    //         }
                                    ?>
                                </ul>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-lock"></i>
                                    <p>
                                        E-Pin Management
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="display: none;">
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('Dashboard/Settings/epins/0'); ?>" class="nav-link">
                                            <i class="right fas fa-angle-right"></i>
                                            <p>Unused Epins</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('Dashboard/Settings/epins/1'); ?>" class="nav-link">
                                            <i class="right fas fa-angle-right"></i>
                                            <p>Used Epins</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('Dashboard/Settings/epins/2'); ?>" class="nav-link">
                                            <i class="right fas fa-angle-right"></i>
                                            <p>Transferred Epins</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('Dashboard/TransferIncome') ?>" class="nav-link">
                                            <i class="right fas fa-angle-right"></i>
                                            <p>Generate Epin</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('Dashboard/Settings/epins/3'); ?>" class="nav-link">
                                            <i class="right fas fa-angle-right"></i>
                                            <p>Epins History</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('Dashboard/Settings/transfer_epins'); ?>" class="nav-link">
                                            <i class="right fas fa-angle-right"></i>
                                            <p>Pin Transfer</p>
                                        </a>
                                    </li>


                                </ul>
                            </li>
                            <li class="nav-item has-treeview menu-open">
                                <a href="<?php echo base_url('Dashboard/User/Register/?sponser_id=' . $user_info->user_id); ?>" target="_blank" class="nav-link">
                                    <i class="far fa-registered"></i>
                                    <p>
                                        Register New User
                                    </p>
                                </a>
                            </li>
                            <!-- <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-chart-pie"></i>
                                    <p>
                                        Account Activation
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="display: none;">
                                    <li class="nav-item">
                                        <a href="<?php// echo base_url('Dashboard/ActivateAccount'); ?>" class="nav-link">
                                            <i class="right fas fa-angle-right"></i>
                                            <p>Activate Account</p>
                                        </a>
                                    </li>
                                </ul>
                            </li> -->
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-user"></i>
                                    <p>
                                        Profile Management
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="display: none;">
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('Dashboard/User/Profile'); ?>" class="nav-link">
                                            <i class="right fas fa-angle-right"></i>
                                            <p>Profile Edit</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('Dashboard/User/password_reset/'); ?>" class="nav-link">
                                            <i class="right fas fa-angle-right"></i>
                                            <p>Change Password</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('Dashboard/User/trans_password/'); ?>" class="nav-link">
                                            <i class="right fas fa-angle-right"></i>
                                            <p>Change Txn Password</p>
                                        </a>
                                    </li>


                                </ul>
                            </li>

                            <!-- <li class="nav-item has-treeview">
                                <a href="<?php //echo base_url('Dashboard/Task'); ?>" class="nav-link">
                                   <i class="nav-icon fas fa-tachometer-alt"></i>
                                   <p>
                                      Online Video Material's
                                   </p>
                                </a>
                             </li> -->
                            <!-- <li class="nav-item has-treeview">
                               <a href="<?php //echo base_url('Dashboard/coupans'); ?>" class="nav-link">
                                  <i class="nav-icon fas fa-tachometer-alt"></i>
                                  <p>
                                     Shopping Coupons
                                  </p>
                               </a>
                            </li> -->
                            <!-- <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-chart-pie"></i>
                                    <p>
                                        E-wallet
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="display: none;">
                                    <li class="nav-item">
                                        <a href="<?php //echo base_url('Dashboard/Fund/Request_fund'); ?>" class="nav-link">
                                            <i class="right fas fa-angle-right"></i>
                                            <p>Request E-wallet</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php //echo base_url('Dashboard/Fund/requests'); ?>" class="nav-link">
                                            <i class="right fas fa-angle-right"></i>
                                            <p>E-wallet Request History</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php// echo base_url('Dashboard/Fund/transfer_fund'); ?>" class="nav-link">
                                            <i class="right fas fa-angle-right"></i>
                                            <p>Transfer Wallet Money</p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="<?php //echo base_url('Dashboard/Fund/wallet_ledger'); ?>" class="nav-link">
                                            <i class="right fas fa-angle-right"></i>
                                            <p>E-wallet History</p>
                                        </a>
                                    </li>
                                </ul>
                            </li> -->
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="fab fa-product-hunt"></i>
                                    <p>
                                        Payout Reports  
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="display: none;">
                                    <?php
                                    $incomes = incomes();
                                    foreach ($incomes as $key => $income) {
                                        echo' <li class="nav-item">
                                    <a href="' . base_url('Dashboard/User/Income/' . $key) . '" class="nav-link">
                                       <i class="right fas fa-angle-right"></i>
                                       <p>' . $income . '</p>
                                    </a>
                                 </li>';
                                    }
                                    ?>

                                    <li class="nav-item">
                                        <a href="<?php echo base_url('Dashboard/User/income_ledgar'); ?>" class="nav-link">
                                            <i class="right fas fa-angle-right"></i>
                                            <p>Payout Summary</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-lock"></i>
                                    <p>
                                        ROI Reports
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="display: none;">
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('Dashboard/Task/ROILIST/single_leg'); ?>" class="nav-link">
                                            <i class="right fas fa-angle-right"></i>
                                            <p>Single Leg ROI</p>
                                        </a>
                                    </li>

                                </ul>
                            </li>
                            <!-- <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-chart-pie"></i>
                                    <p>
                                        Banking
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="display: none;">

                                </ul>
                            </li> -->
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="far fa-money-bill-alt"></i>
                                    <p>
                                        Withdraw Money
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="display: none;">


                                    <li class="nav-item">
                                        <a href="<?php echo base_url('Dashboard/Withdraw/ActivateBanking'); ?>" class="nav-link">
                                            <i class="right fas fa-angle-right"></i>
                                            <p>1. Activate Banking</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('Dashboard/Withdraw/AddBeneficiary'); ?>" class="nav-link">
                                            <i class="right fas fa-angle-right"></i>
                                            <p>2. Add New Beneficary</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('Dashboard/Withdraw/BeneficiaryList'); ?>" class="nav-link">
                                            <i class="right fas fa-angle-right"></i>
                                            <p>3. IMPS Transfer</p>
                                        </a>
                                    </li>
                                    <!-- <li class="nav-item">
                                        <a href="<?php //echo base_url('Dashboard/SecureWithdraw/addBeneficiary'); ?>" class="nav-link">
                                            <i class="right fas fa-angle-right"></i>
                                            <p>1. Add New Beneficiary</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php //echo base_url('Dashboard/SecureWithdraw/beneficiaryList'); ?>" class="nav-link">
                                            <i class="right fas fa-angle-right"></i>
                                            <p>2. Bank Transfer</p>
                                        </a>
                                    </li> -->

                                    <!-- <li class="nav-item">
                                        <a href="<?php //echo base_url('Dashboard/DirectIncomeWithdraw')  ?>" class="nav-link">
                                            <i class="right fas fa-angle-right"></i>
                                            <p>Withdraw</p>
                                        </a>
                                    </li> -->


                                    <li class="nav-item">
                                        <a href="<?php echo base_url('Dashboard/bank_transfer_summary') ?>" class="nav-link">
                                            <i class="right fas fa-angle-right"></i>
                                            <p>Bank Transfer Summary</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                   <i class="fas fa-table"></i>
                                    <p>
                                        Support
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="display: none;">
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('Dashboard/Support/Inbox'); ?>" class="nav-link">
                                            <i class="right fas fa-angle-right"></i>
                                            <p>Inbox</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('Dashboard/Support/Outbox'); ?>" class="nav-link">
                                            <i class="right fas fa-angle-right"></i>
                                            <p>Outbox</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('Dashboard/Support/ComposeMail'); ?>" class="nav-link">
                                            <i class="right fas fa-angle-right"></i>
                                            <p>Compose Mail</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="<?php echo base_url('Dashboard/User/logout'); ?>" class="nav-link">
                                   <i class="fas fa-power-off"></i>
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
            <script>
                function addclass() {
                    if ($('.sidebar-mini')) {
                        var id = $(this).data('val');
                        if (id == 1) {
                            $('#toggleid').addClass("sidebar-collapse")
                            $(this).data('val').remove();
                        } else {
                            $('#toggleid').removeClass("sidebar-collapse")
                            $(this).data('val').add('1');
                        }
                    }
                }

            </script>
