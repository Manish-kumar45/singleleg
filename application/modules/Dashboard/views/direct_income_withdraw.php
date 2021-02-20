<?php include_once'header.php';
date_default_timezone_set("Asia/Kolkata");
?>
  <div class="content-wrapper" style="background:white">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Direct Income withdraw</h1>
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
        <div class="row" >
          <div class="col-md-6">
            <h1 style="color:red; font-size:20px; font-weight:bold;display:">Now WithDraw Timing is 8AM to 11AM And Minimum withdraw Rs.200 and Multiple by Rs. 200</h1>
            <?php
            echo $date = date('H:i');
            if(date('w') < 6 && $date >= '08:00' && $date <= '08:00'){

                echo form_open('',array('id' => 'TopUpForm'));?>
            <span class="text-danger"><?php echo $this->session->flashdata('message'); ?></span>
            <div class="form-group">
                <label style="font-size:20px; color:red">Available balance (Rs. <?php echo $balance['balance'];?>)</label><br>
            </div>
            <div class="form-group">
                <label>Amount</label>
                <input type="text" class="form-control" name="amount" id="amount" onblur="calculate_net_amount();" placeholder="Amount" value="<?php echo set_value('amount');?>"/>
                <span class="text-danger"><?php echo form_error('amount')?></span>
            </div>
            <div class="form-group">
                <label>Admin Charges</label>
                <span class="text-info">5%</span>
            </div>
            <div class="form-group">
                <label>Net Amount</label>
                <span class="text-success" id="netAmount"></span>
            </div>
            <div class="form-group">
                <label>100% E-wallet Transfer</label><br>

                <input type="radio" name="pin_transfer" onclick="calculate_net_amount();" value="0" checked>No
            </div>
            <div class="form-group">
                <label>Bank Amount</label>
                <span class="text-success" id="bankAmount"></span>
            </div>
            <div class="form-group">
                <label>TDS Charges 5%</label>
                <span class="text-success" id="tds"></span>
            </div>
            <div class="form-group">
                <label>Net. Bank Amount</label>
                <span class="text-success" id="NetbankAmount"></span>
            </div>
            <div class="form-group">
                <label>Transaction Pin</label>
                <input type="password" class="form-control" name="master_key" placeholder="Master Key" value=""/>
                <span class="text-danger"><?php echo form_error('master_key')?></span>
            </div>
            <div class="form-group">
                <button type="subimt" name="save" class="btn btn-success" />WithDraw Now</button>
            </div>
            <?php echo form_close();
            }else{
                echo '<span class="text-danger">Withdraw Between 8Am to 11 AM Monday to Friday </span>';
                // echo '<span class="text-danger">Manual withdraw is stopped Please Withdraw from Api</span>';
            }

            ?>
          </div>
        </div>
    </div>
</div>
  </div>
<?php include_once'footer.php'; ?>
<script>
    $(document).on('blur','#user_id',function(){
        var user_id = $('#user_id').val();
        if(user_id != ''){
            var url  = '<?php echo base_url("Dashboard/get_app_user/")?>'+user_id;
            $.get(url,function(res){
                if(res.success == 1){
                    $('#errorMessage').html(res.user.name);
                }else{
                    $('#errorMessage').html(res.message);
                }

            },'json')
        }
    })
    $(document).on('submit','#TopUpForm',function(){
        if (confirm('Are You Sure U want to Withdraw This Account')) {
            yourformelement.submit();
        } else {
            return false;
        }
    })
    $(document).on('blur','#amount',function(){
      var amount = $(this).val();
    //   var netAmount = amount * 90 /100;
    //   $('#netAmount').text(netAmount);
    })
    function calculate_net_amount(){
        var amount = $('#amount').val();
        var bankAmount;
        var tds = 0;
        var transfer_wallet = $("input[name='pin_transfer']:checked").val();
        console.log(transfer_wallet);
        if(transfer_wallet == 0){
            bankAmount = amount * 90 /100;
            tds = amount * 5 /100;
        }else{
            bankAmount = amount * 90 /100;
            tds = amount * 5 /100;
        }

        var NetbankAmount = (bankAmount);
        $('#NetbankAmount').text(NetbankAmount);
        $('#bankAmount').text(bankAmount);
        $('#tds').text(tds);
    }
</script>
