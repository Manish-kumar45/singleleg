<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Fund Transfer (Rs<?php echo $wallet_amount['wallet_amount'] ?>)</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Fund Transfer</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <?php 
                    if($show_otp == 0){
                        echo form_open(base_url('Dashboard/Fund/transfer_fund'), array('method' => 'post')); ?>
                    <div class="row">
                        <span class="text-center">
                            <h3><?php echo $this->session->flashdata('message'); ?></h3>
                        </span>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Amount</label>
                                <?php
                                    echo form_input(array('type' => 'number', 'name' => 'amount', 'class' => 'form-control','value' => set_value('amount')));
                                    ?>
                            </div>
                            <div class="form-group">
                                <label>User ID:</label>
                                <?php
                                    echo form_input(array('type' => 'text', 'name' => 'user_id', 'class' => 'form-control', 'id' => 'user_id','value' => set_value('user_id')));
                                    ?>
                                <span class="text-danger" id="userName"></span>
                            </div>
                            <div class="form-group">
                                <label>Remark:</label>
                                <?php
                                    echo form_input(array('type' => 'text', 'name' => 'remark', 'class' => 'form-control','value' => set_value('remark')));
                                    ?>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="otp" />
                                <?php
                                    echo form_input(array('type' => 'submit', 'class' => 'btn btn-success pull-right', 'name' => 'fundbtn', 'value' => 'Transfer'));
                                    ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    echo form_close();
                    }
                    elseif($show_otp == 1)
                    {
                        echo form_open(base_url('Dashboard/Fund/transfer_fund'), array('method' => 'post'));
                    ?>
                    <div class="row">
                        <span class="text-center">
                            <h3><?php echo $this->session->flashdata('message'); ?></h3>
                        </span>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Amount</label>
                                <?php
                                    echo form_input(array('type' => 'number', 'name' => 'amount', 'class' => 'form-control' ,'value' => set_value('amount')));
                                    ?>
                            </div>
                            <div class="form-group">
                                <label>User ID:</label>
                                <?php
                                    echo form_input(array('type' => 'text', 'name' => 'user_id', 'class' => 'form-control', 'id' => 'user_id','value' => set_value('user_id')));
                                    ?>
                                <span class="text-danger" id="userName"></span>
                            </div>
                            <div class="form-group">
                                <label>Remark:</label>
                                <?php
                                    echo form_input(array('type' => 'text', 'name' => 'remark', 'class' => 'form-control','value' => set_value('remark')));
                                    ?>
                            </div>
                            <div class="form-group">
                                <label>One Time Password:</label>(A One Time Password Sent on Your Registered Phone
                                Number )
                                <?php
                                    echo form_input(array('type' => 'text', 'name' => 'otp', 'class' => 'form-control','value' => set_value('otp')));
                                    ?>
                                <span class="text-danger"><?php echo form_error('otp');?></span>
                                <span class="text-danger" id="timer"></span>
                            </div>
                            <div class="form-group">
                                <?php
                                    echo form_input(array('type' => 'submit', 'class' => 'btn btn-success pull-right', 'name' => 'fundbtn', 'value' => 'Transfer'));
                                    ?>
                            </div>
                        </div>
                    </div>
                    <script>
                    // Set the date we're counting down to
                    var countDownDate = new Date(
                        "<?php echo date('Y-m-d H:i:s', strtotime('+3 minute', strtotime($otp_time))); ?>")
                    .getTime();

                    // Update the count down every 1 second
                    var x = setInterval(function() {

                        // Get today's date and time
                        var now = new Date().getTime();

                        // Find the distance between now and the count down date
                        var distance = countDownDate - now;

                        // Time calculations for days, hours, minutes and seconds
                        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                        // Display the result in the element with id="demo"
                        document.getElementById("timer").innerHTML = minutes + "m " + seconds + "s ";

                        // If the count down is finished, write some text
                        if (distance < 0) {
                            clearInterval(x);
                            document.getElementById("timer").innerHTML = "EXPIRED";
                        }
                    }, 1000);
                    </script>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('footer'); ?>
<script>
$(document).on('blur', '#user_id', function() {
    if ($(this).val() != '') {

        var url = '<?php echo base_url("Dashboard/User/get_user/") ?>' + $(this).val();
        $.get(url, function(res) {
            $('#userName').html(res)
        })
    }
})
</script>