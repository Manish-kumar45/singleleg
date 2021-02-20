<?php include_once'header.php'; ?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Account Banking</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">Activate Banking</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="container-fluid">
            <h3 class="text-danger"><?php echo $this->session->flashdata('message'); ?></h3>
            <!--<a href="<?php echo base_url('Dashboard/Withdraw/AddBeneficiary'); ?>" style="background:red; color:white;padding:10px 15px">Add Your Bank Details</a>-->
            <?php
            // if($user['netbanking'] == 0){

            echo form_open('', array('id' => 'TopUpForm'));
            ?>
            <div class="form-group" >
                <label>OTP</label>
                <input type="text" class="form-control" name="otp" value="<?php echo set_value('otp'); ?>"
                       placeholder="OTP" style="max-width: 400px" />
                <span class="text-danger"><?php echo form_error('otp') ?></span>
                <a href="<?php echo base_url('Dashboard/Withdraw/ActivateBanking'); ?>" type="button" id="ActBank" class="btn btn-success" />Generate OTP</a>
            </div>
            <div class="form-group" >
                <button type="submit" class="btn btn-success" />Process</button>
            </div>
            <?php
            echo form_close();
            // }else{ 
            //     echo'Banking is Activate';
            // }
            ?>

        </div>
    </div>
</div>
<?php include_once'footer.php'; ?>
<script>
  
</script>