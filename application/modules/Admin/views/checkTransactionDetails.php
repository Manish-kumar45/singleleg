<?php include'header.php' ?>
<div class="content-wrapper" style="min-height: 378px;">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo $header; ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
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
            <h3 class="text-danger"><?php echo $this->session->flashdata('message');?></h3>
            <div class="row">
                <div class="col-6">
                    <ul class="list-group">
                        <li class="list-group-item active">Transaction Details</li>
                        <li class="list-group-item">User ID : <?php echo $transaction['user_id']?></li>
                        <li class="list-group-item">Order ID : <?php echo $transaction['orderid']?></li>
                        <li class="list-group-item">Beneficiary ID : <?php echo $transaction['beneficiaryid']?></li>
                        <li class="list-group-item">Amount : <?php echo $transaction['amount']?></li>
                        <li class="list-group-item">Payable Amount : <?php echo $transaction['payable_amount']?></li>
                        <li class="list-group-item">TXN ID : <?php echo $transaction['operatortxnid']?></li>
                        
                    </ul>
                </div>
                <div class="col-6">
                    <ul class="list-group">
                        <li class="list-group-item active">Pay2All Transaction Details</li>
                        <li class="list-group-item">Status : <?php if($pay2all['status_id'] == 1){
                            echo '<label class="btn btn-success btn-sm">Successfully Transfer</label>';
                        }elseif($pay2all['status_id'] == 2){
                            echo '<label class="btn btn-danger btn-sm">Faild Transfer</label>';
                        }elseif($pay2all['status_id'] == 3){
                            echo '<label class="btn btn-primary btn-sm">In Proccess</label>';
                        }elseif($pay2all['status_id'] == 4){
                            echo '<label class="btn btn-success btn-sm">Faild Transfer and Refund</label>';
                        } ?></li>
                        <li class="list-group-item">Client ID : <?php echo $pay2all['client_id'];?></li>
                        <li class="list-group-item">Account No : <?php echo $pay2all['number'];?></li>
                        <li class="list-group-item">Amount : <?php echo $pay2all['amount'];?></li>
                        <li class="list-group-item">Profit : <?php echo $pay2all['profit'];?></li>
                        <li class="list-group-item">UTR : <?php echo $pay2all['utr'];?></li>
                        <li class="list-group-item">Report ID : <?php echo $pay2all['report_id'];?></li>

                        
                    </ul>
                </div>
            </div>
            <hr>
        </div>
    </div>
</div>
<?php include'footer.php' ?>
