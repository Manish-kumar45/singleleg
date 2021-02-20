<?php include'header.php' ?>
<div class="content-wrapper" style="min-height: 378px;">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Fund Request List</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Fund Request List</li>
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
                                    <th>Amount</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Remark</th>
                                    <th>CreatedAt</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($requests as $key => $request) {
                                    ?>
                                    <tr>
                                        <td><?php echo ($key + 1) ?></td>
                                        <td><?php echo $request['user_id']; ?></td>
                                        <td>Rs. <?php echo $request['amount']; ?></td>
                                        <td><img src="<?php echo base_url('uploads/' . $request['image']); ?>" height="100px" width="100px"></td>
                                        <td><?php
                                            if ($request['status'] == 0) {
                                                echo'<span class="btn btn-primary">Pending</span>';
                                            } elseif ($request['status'] == 1) {
                                                echo'<span class="btn btn-success">Approved</span>';
                                            } elseif ($request['status'] == 2) {
                                                echo'<span class="btn btn-danger">Rejected</span>';
                                            }
                                            ?></td>
                                        <td><?php echo $request['remarks']; ?></td>
                                        <td><?php echo $request['created_at']; ?></td>
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
