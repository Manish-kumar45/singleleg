<?php include'header.php' ?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Paid users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Paid users</li>
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
                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
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
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Sponsor ID</th>
                            <!-- <th>Size</th> -->
                            <th>Joining Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach ($users as $key => $user) {
                            ?>
                            <tr>
                                <td><?php echo ($key + 1) ?></td>
                                <td><?php echo $user['user_id']; ?></td>
                                <td><?php echo $user['name'] ; ?></td>
                                <td><?php echo $user['phone']; ?></td>
                                <td><?php echo $user['sponser_id']; ?></td>
                                <td><?php echo $user['created_at']; ?></td>
                                <td>
                                  <a href="<?php echo base_url('Admin/Management/user_login/'.$user['user_id']);?>" target="_blank">Login</a>
                                  <?php
                                  // if($user['invoice_status'] == 0){
                                  //   echo'<button class="btn btn-info courierInfo" data-user_id="'.$user['user_id'].'" type="button">Courier</button>';
                                  // }
                                  ?>
                                </td>
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


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <?php echo form_open(base_url('Admin/Management/UpdateInvoiceStatus'),array('id' => 'courierForm'));?>
        <div class="form-group">
          <label>Courier Company Name</label>
          <input type="text" class="form-control" name="courier_company" required>
        </div>
        <div class="form-group">
          <label>Tracking ID</label>
          <input type="text" class="form-control" name="courier_number" required>
          <input type="hidden" id="courier_user_id" name="user_id" class="form-control" name="courier_number" required>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-success">Save</button>
        </div>
        <?php echo form_close();?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php include'footer.php' ?>
<script>
  $(document).on('click','.courierInfo',function(){
      var user_id = $(this).data('user_id');
      $('#courier_user_id').val(user_id);
      $('#myModal').modal('show');
  })
  $(document).on('submit','#courierForm',function(e){
    e.preventDefault();
    var url = $(this).attr('action');
    var formData = $(this).serialize();
    var t = $(this);
    $.post(url,formData,function(res){
      alert(res.message);
      t.append('<input type="hidden" name="'+res.token_name+'" value="'+res.token+'" style="display:none;">');
      if(res.success == 1)
        location.reload();
    },'json')
  })
</script>