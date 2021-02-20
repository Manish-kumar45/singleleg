<?php
include_once 'header.php';
date_default_timezone_set("Asia/Kolkata");
?>
<div class="content-wrapper" style="background:white">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Fund withdraw</h1>
                    <span>Minimum Withdrawal Amount Rs 200</span>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">Withdrwa Management</li>
                        <li class="breadcrumb-item active">Withdraw</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">

                    <?php

                    echo $date = date('H:i');
                    //
                //     if(!empty($_GET['status'])){

                //     $ips = $_GET['status'];
                // }else{
                     //$ips = 0;
                // }
                     //$ips = 0;
                    $xxx = 1;
                    if($xxx == 1){

                    
                   if ($date >= '10:00' && $date <= '17:00' && date('D') != 'Sun') {

                        echo form_open('', array('id' => 'TopUpForm'));
                        ?>
                        <span class="text-danger"><?php echo $this->session->flashdata('message'); ?></span>
                        <div class="form-group">
                            <label style="font-size:20px; color:red">Available balance (Rs.
                                <?php echo $balance['balance']; ?>)</label><br>
                        </div>
                        <div class="form-group">
                            <label>Benficiary ID</label>
                            <input type="text" class="form-control" name="beneficiary_id" placeholder="Beneficiary ID"
                                   value="<?php echo $beneficiary_id; ?>" />
                            <span class="text-danger"><?php echo form_error('beneficiary_id') ?></span>
                        </div>
                        <div class="form-group">
                            <label>Amount</label>
                            <input type="text" class="form-control" name="amount" id="amount"
                                   onblur="calculate_net_amount();" placeholder="Amount"
                                   value="<?php echo set_value('amount'); ?>" />
                            <span class="text-danger"><?php echo form_error('amount') ?></span>
                        </div>
                        <div class="form-group">
                            <label>Transaction Pin</label>
                            <input type="password" class="form-control" name="master_key" placeholder="Master Key"
                                   value="" />
                            <span class="text-danger"><?php echo form_error('master_key') ?></span>
                        </div>
                        <div class="form-group">
                            <label>OTP</label>
                            <input type="password" class="form-control" name="otp" placeholder="Enter OTP"
                                   value="" />
                            <span class="text-danger"><?php echo form_error('otp') ?></span>
                            <button type="button" class="btn btn-success" id="otp">GET OTP</button>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="save" class="btn btn-success" />WithDraw Now</button>
                        </div>
                        <?php
                        echo form_close();
                   } else {
                        echo '<br><span class="text-danger">Withdraw Between 10AM to 5 PM Monday to Saturday. <br> <b style="font-size:18px">Sunday Closed</b> </span>';
                       // echo '<span class="text-danger">Due TO Banking Issue Withdraw Section Stopped for some please Try After 2PM. Thanks</b> </span>';
                    // echo '<br><h1><span class="text-danger">We are changing the banking process please wait for some time</b> </span><h1>';
                   // echo '<br><h1><span class="text-danger">Due TO SMS Issue Withdraw Section Stopped for some time.</b> </span></h1>';
                    // echo '<br><h1><span class="text-danger">Due TO Banking Issue Withdraw Section Stopped for some time.</b> </span></h1>';
                   }
               }else{
echo '<h2 class="text-danger">Withdraw is closed due to internet connectivity in Haryana.</h2>';

               }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once 'footer.php'; ?>
<script>
$(document).on('click','#otp',function(){
    var url = '<?php echo base_url('Dashboard/Support/generateKey');?>'
    $.get(url,function(res){
        if(res.success == 1){
            $("#otp").css("display", "none");
            alert('OTP send to registered mobile number');
        }else{
            alert('Network error,please try later');
        }
    },'JSON')
})
</script>
