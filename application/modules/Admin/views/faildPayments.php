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
                    <span class="text-danger"><?php echo $this->session->flashdata('message'); ?></span>
                    <div class="table-responsive p-4 bg-white mb-4">
                        <table class="table table-bordered table-striped dataTable" id="tableView">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User ID</th>
                                <th>Amount</th>
                                <th> Date</th>
                                <th> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($messages as $key => $message) {
                                ?>
                                <tr>
                                    <td><?php echo ($key + 1) ?></td>
                                    <td><?php echo $message['user_id']; ?></td>
                                    <td><?php echo $message['amount']; ?></td>
                                    <td><?php echo $message['created_at']; ?></td>
                                    <td><a href="<?php echo base_url('Admin/Withdraw/faildPaymentsReturn/'.$message['id'].'');?>">Return</a></td>
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
