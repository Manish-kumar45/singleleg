<?php include'header.php' ?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Users Pins</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Users Pins</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Users Pins</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                      <a href="<?php echo base_url('Admin/Settings/DebitEpins/'.$pins[0]['user_id']);?>" class="btn btn-success">Debit Epins</a>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover" id="tableView">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User ID</th>
                            <th>Epin</th>
                            <th>Send by</th>
                            <th>Status</th>
                            <th>Used For</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach ($pins as $key => $pin) {
                            ?>
                            <tr>
                                <td><?php echo ($key + 1) ?></td>
                                <td><?php echo $pin['user_id']; ?></td>
                                <td><?php echo $pin['epin']; ?></td>
                                <td><?php echo $pin['sender_id'] == '' ? 'Admin' : $pin['sender_id']; ?></td>
                                <td><?php 
                                if($pin['status'] == 0 ){
                                    echo'<span class="text-primary">UnUsed</span>';
                                }elseif($pin['status'] == 1 ){
                                    echo'<span class="text-success">Used</span>';
                                }elseif($pin['status'] == 2 ){
                                    echo'<span class="text-danger">Transferred</span>';
                                }
                                ?></td>
                                <td><?php echo $pin['used_for'] ; ?></td>
                                <td><?php echo $pin['created_at'] ; ?></td>
                            </tr>
                            <?php
                        }
                        ?>

                    </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </div>
  </div>
<?php include'footer.php' ?>