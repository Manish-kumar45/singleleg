<div class="content-wrapper" style="min-height: 378px;">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Fund Request</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><?php //echo $header;?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="container-fluid">
            <?php echo form_open_multipart();?>
            <div class="row">
                <div class="col-md-6">
                    <h2><?php echo $this->session->flashdata('message');?></h2>
                    <div class="form-group">
                        <label>Payment Method</label>
                        <?php
                        echo form_dropdown('payment_method',array('bank' => 'Bank', 'phonepay' => 'Phone Pay', 'googlepay' => 'Google Pay' , 'paytm' => 'Paytm', 'upi' => 'UPI', 'cash' => 'Cash Deposit'),'',array('class'=>'form-control'));
                        ?>
                    </div>
                    <div class="form-group">
                        <label>Amount</label>
                        <?php
                        echo form_input(array('type' => 'number', 'name' => 'amount', 'class' => 'form-control'));
                        ?>
                    </div>
                    <div class="form-group">
                        <label>Upload Proof Here</label>
                        <?php
                        echo form_input(array('type' => 'file', 'name' => 'userfile', 'class' => 'form-control' , 'id' => 'payment_slip','size' => 20));
                        ?>
                    </div>
                    <div class="form-group">
                        <?php
                        echo form_input(array('type' => 'submit' , 'class' => 'btn btn-success pull-right','name' => 'fundbtn','value' => 'Request'));
                        ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <img src="<?php echo base_url('classic/no_image.png');?>" title="Payment Slip" id="slipImage" style="width: 100%;">
                </div>
            </div>
            <?php echo form_close();?>
        </div>
    </div>
</div>
<?php  $this->load->view('footer');?>
<script>
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#slipImage').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#payment_slip").change(function () {
        readURL(this);
    });
    $(document).on('submit', '#paymentForm', function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $('#savebtn').css('display', 'none');
        $('#uploadnot').css('display', 'block');
        var action = $(this).attr('action');
        $.ajax({
            url: action,
            type: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function (data)
            {
                data = JSON.parse(data);
                if (data.success === 1)
                {
                    toastr.success(data.message);
//                    swal("Thank You", data.message);
                    //window.location = "https://soarwaylife.in/Dashboard/request_money.php" + data.message;
                    location.reload();
                } else {
                    toastr.error(data.message);
                }
                $('#savebtn').css('display', 'block');
                $('#uploadnot').css('display', 'none');
            }
        });
    });


</script>
