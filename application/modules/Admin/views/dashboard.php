<?php include_once'header.php'; ?>
<style>
  h3 a {
      color: white;
  }
  a h3 {
      color: white;
  }
</style>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                    <h1 class="m-0 text-dark"><?php echo $header; ?></h1>
                </div>
                <div class="col-sm-4">
                    <h5>SMS Left:<?php echo 5000-$totalSms;?></h5>
                </div><!-- /.col -->
                <div class="col-sm-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><?php echo $header; ?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-12">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <a href="<?php echo base_url('Admin/Withdraw/incomeLedgar');?>"><h3>Total Payout</h3></a>
                            <p>Total : <?php echo number_format($total_payout,2);?></p>
                            <p>Total IMPS: <?php echo number_format($total_imps,2);?></p>
                            <p>Pending Payout: <?php echo number_format($total_payout - $total_imps,2);?></p>
                            
                        </div>
                        <div class="icon">
                            <i class="fa fa-inr"></i>
                        </div>

                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-12">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <a href="<?php echo base_url('Admin/Withdraw/income/task_income');?>"><h3>Single leg Income</h3></a>
                            <p>Total : <?php echo number_format($single_leg,2);?></p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-inr"></i>
                        </div>

                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-12">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <a href="<?php echo base_url('Admin/Withdraw/income/direct_income');?>"><h3>Direct Income</h3></a>
                            <p>Total : <?php echo number_format($direct_income,2);?></p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-inr"></i>
                        </div>

                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-12">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <a href="<?php echo base_url('Admin/Withdraw/income/direct_income');?>"><h3>Level Income</h3></a>
                            <p>Total : <?php echo number_format($level_income,2);?></p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-inr"></i>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <a href="<?php echo base_url('Admin/Withdraw/income/royalty_income');?>"><h3>Royalty Income</h3></a>
                            <p>Total : <?php echo number_format($royalty_income,2);?></p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-inr"></i>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <a href="<?php echo base_url('Admin/Withdraw/income/leadership_income');?>"><h3>Leadership Income</h3></a>
                            <p>Total : <?php echo number_format($leadership_income,2);?></p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-inr"></i>
                        </div>

                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-12">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><a href="<?php echo base_url('Admin/Management/users/');?>">Total Members</a></h3>
                            <p>Total : <?php echo $total_users;?></p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-shopping-cart"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <div class="row">
                <div class="col-lg-4 col-12">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <a href="<?php echo base_url('Admin/Management/paidUsers/');?>"><h3>Paid Members</h3></a>
                            <p class="mb-0">Total : <?php echo $paid_users;?></p>
                          </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <a href="<?php echo base_url('Admin/Management/today_joinings/');?>"><h3>Today Joined <br>Members</h3></a>
                            <p class="mb-0">Total : <?php echo $today_joined_users;?></p>
                          </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>

                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-12">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>Payout</h3>
                            <p class="mb-0">Direct Payout.: <?php echo abs(number_format($direct_income_withdraw_request,2));?></p>
                            <p class="mb-0">Total Payout : <?php echo number_format($total_income_generated,2);?></p>
                            <p class="mb-0">Converted to Ewallet : <?php echo number_format($income_transfer_wallet,2);?></p>
                            <p class="mb-0">Payout Withdraw Request : <?php echo number_format($total_withdraw,2);?></p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-inr"></i>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4 col-12" style="display:none;">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>E-Wallet</h3>
                            <p class="mb-0">Wallet Bal.: <?php echo $total_sent_fund;?></p>
                            <p class="mb-0">Income Generated Fund : <?php echo $income_generated_fund;?></p>
                            <p class="mb-0">Available fund in user Balance: <?php echo $user_available_balance;?></p>
                            <p class="mb-0">Used : <?php echo $used_fund;?></p>
                            <p>Requested : <?php echo $requested_fund;?></p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-inr"></i>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>E-Pins</h3>
                            <p class="mb-0">Total Pins: <?php echo $total_epins;?></p>
                            <p class="mb-0">Available Pins: <?php echo $available_epins;?></p>
                            <p class="mb-0">Used Pins: <?php echo $used_epins;?></p>
                           <!--  <p class="mb-0" style="color:white"> <a href="<?php //echo base_url('Admin/Withdraw/income/pin_generation')?>">Pin Generation: <?php //echo abs($pin_generation / 770);?></a></p> -->
                        </div>
                        <div class="icon">
                            <i class="fa fa-inr"></i>
                        </div>

                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-12">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>E-Mail</h3>
                            <p class="mb-0">Total : 0</p>
                            <p class="mb-0">Read : 0</p>
                            <p>Unread : 0</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <!-- <a href="<?php //echo base_url('Dashboard/User/register_cron');?>">Register Members</a> -->
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
<?php include_once'footer.php'; ?>
