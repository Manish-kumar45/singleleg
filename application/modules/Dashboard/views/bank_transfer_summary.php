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
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive p-4 bg-white mb-4">
                        <table class="table table-bordered table-striped dataTable" id="tableView">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User ID</th>
                                    <th>Beneficiary ID</th>
                                    <th>Order ID</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Transaction ID</th>
                                    <th>UTR</th>
                                    <th>Deducted Amount</th>
                                    <th>Transfer Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($transactions as $key => $transaction) {
                                    if($transaction['status'] == 'SUCCESS'){
                                        $status = '<label class="btn btn-success btn-sm">SUCCESS TRANSACTION</label>';
                                    }elseif($transaction['status'] == 'FAILED'){
                                        $status = '<label class="btn btn-danger btn-sm">FAILD TRANSACTION</label>';
                                    }elseif($transaction['status'] == 3){
                                        $status = '<label class="btn btn-primary btn-sm">IN PROGRESS TRANSACTION</label>';
                                    }elseif($transaction['status'] == 4){
                                        $status = '<label class="btn btn-info btn-sm">TRANSACTION FAILD AMOUNT REFUND</label>';
                                    }
                                    ?>
                                    <tr>
                                        <td><?php echo ($key + 1) ?></td>
                                        <td><?php echo $transaction['user_id']; ?></td>
                                        <td><?php echo $transaction['beneficiaryid']; ?></td>
                                        <td><?php echo $transaction['orderid']; ?></td>
                                        <td>Rs.<?php echo $transaction['amount']; ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td><?php echo $transaction['joloorderid']; ?></td>
                                        <td><?php echo $transaction['operatortxnid']; ?></td>
                                        <td>RS.<?php echo $transaction['payable_amount']; ?></td>
                                        <td><?php echo $transaction['created_at']; ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--end: Datatable -->
        </div>
    </div>
</div>
<?php include'footer.php' ?>