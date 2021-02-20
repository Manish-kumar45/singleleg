<?php include'header.php' ?>
<div class="content-wrapper" style="min-height: 378px; background:white">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Epins</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Epins</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
              <div style="max-width:100%; overflow:scroll">
                <table class="table table-bordered table-striped dataTable" id="tableView">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>EPin</th>
                            <th>Received From</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Used For</th>
                            <th>Action</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($records as $key => $record) {
                            ?>
                            <tr>
                                <td><?php echo ($key + 1) ?></td>
                                <td><?php echo $record['epin']; ?></td>
                                <td><?php echo $record['sender_id'] == '' ? 'Admin' : $record['sender_id']; ?></td>
                                <td><?php echo $record['amount']; ?></td>
                                <td>
                                    <?php
                                    if($record['status'] == 0){
                                        echo '<span class="text-info">Unused</span>';
                                    }elseif($record['status'] == 1){
                                        echo'<span class="text-success">Used</span>';
                                    }elseif($record['status'] == 2){
                                        echo'<span class="text-primary">Transferred</span>';
                                    }
                                    ?>
                                </td>
                                <td><?php echo $record['used_for']; ?></td>
                                <td><?php
                                if($record['status'] == 0){
                                    echo'<a href="'.base_url('Dashboard/ActivateAccount/'.$record['epin']).'">Active Now</a>';
                                }
                                ?></td>
                                <td><?php echo $record['created_at']; ?></td>
                            </tr>
                            <?php
                        }
                        ?>

                    </tbody>
                </table></div>
            </div>
        </div>
    </div>
</div>
<?php include'footer.php' ?>
