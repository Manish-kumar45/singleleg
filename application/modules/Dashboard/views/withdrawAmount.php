<?php include_once'header.php';
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
               if($date >= '12:00' && $date <= '17:00'){

                echo form_open('',array('id' => 'TopUpForm'));?>
                    <span class="text-danger"><?php echo $this->session->flashdata('message'); ?></span>
                    <div class="form-group">
                        <label style="font-size:20px; color:red">Available balance (Rs.
                            <?php echo $balance['balance'];?>)</label><br>
                    </div>
                    <div class="form-group">
                        <label>Benficiary ID</label>
                        <input type="text" class="form-control" name="beneficiary_id" placeholder="Beneficiary ID"
                            value="<?php echo $beneficiary_id;?>" />
                        <span class="text-danger"><?php echo form_error('beneficiary_id')?></span>
                    </div>
                    <div class="form-group">
                        <label>Amount</label>
                        <input type="text" class="form-control" name="amount" id="amount"
                            onblur="calculate_net_amount();" placeholder="Amount"
                            value="<?php echo set_value('amount');?>" />
                        <span class="text-danger"><?php echo form_error('amount')?></span>
                    </div>
                    <div class="form-group">
                        <label>Transaction Pin</label>
                        <input type="password" class="form-control" name="master_key" placeholder="Master Key"
                            value="" />
                        <span class="text-danger"><?php echo form_error('master_key')?></span>
                    </div>
                    <div class="form-group">
                            <label>OTP</label>
                            <input type="password" class="form-control" name="otp" placeholder="Enter OTP"
                                   value="" />
                            <span class="text-danger"><?php echo form_error('otp') ?></span>
                            <button type="button" class="btn btn-success" id="otp">GET OTP</button>
                        </div>
                    <div class="form-group">
                        <button type="subimt" name="save" class="btn btn-success" />WithDraw Now</button>
                    </div>
                    <?php echo form_close();
            }else{
               echo '<span class="text-danger">Withdraw Between 12PM to 5PM daily. <br> <b style="font-size:18px">Sunday Closed</b> </span>';
            }
            ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once'footer.php'; ?>
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
