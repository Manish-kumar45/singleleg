<?php include_once'header.php'; ?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Beneficiary List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Beneficiary List</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <h3><?php echo $this->session->flashdata('message'); ?></h3>
                    <div id="some_div"></div>
                    <?php
                    foreach ($beneficiary as $ben) {
                        ?>
                        <div class="card" style="width:400px">
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $ben['recipient_name']; ?></h4>
                                <p class="card-text">
                                    Account Number : <?php echo $ben['account']; ?> <br>
                                    IFSC Code <?php echo $ben['ifsc']; ?><br>
                                    Bank <?php echo $ben['bank']; ?><br>
                                    <!--Bank Branch <?php //echo $ben['beneficiary_branch']; ?> <br>-->
                                    Benficiary ID<?php echo $ben['beneficiary_id']; ?>
                                </p>
                                <a
                                    href="<?php echo base_url('Dashboard/BankWIthdraw/withdraw_amount/' . $ben['beneficiary_id']); ?>">Send
                                    Money</a>
                            </div>
                        </div>

                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once'footer.php'; ?>