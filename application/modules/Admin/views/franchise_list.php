<?php include'header.php' ?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Franchise</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Franchise</li>
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
                <form method="GET" action="<?php echo base_url('Admin/Management/users/');?>">
                <div class="row">
                    <div class="col-3">
                      <select class="form-control" name="type">
                        <option value="user_id" <?php echo $type == 'user_id' ? 'selected' : '';?>>User ID</option>
                        <option value="phone" <?php echo $type == 'phone' ? 'selected' : '';?>>Phone</option>
                        <option value="pin_code" <?php echo $type == 'pin_code' ? 'selected' : '';?>>Pin Code</option>
                      </select>
                    </div>
                    <div class="col-3">
                      <input type="text" name="value" class="form-control float-right" value="<?php echo $value;?>" placeholder="Search">
                    </div>
                    
                    <div class="col-3">
                      <div class="input-group-append">
                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                      </div>
                    </div>
                    <div class="col-3">
                        <a class="btn btn-default" href="<?php echo base_url('Admin/Franchise/AddFranchise');?>">Create New</a>
                    </div>
                  </div>
                </form>
              </div>
            <!-- </div> -->
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <?php echo $this->session->flashdata('message');?>
                <table class="table table-hover" id="">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Pin Code</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                      $i = ($segament) + 1;
                        foreach ($franchises as $key => $franchise) {
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $franchise['name'] ; ?></td>
                                <td><?php echo $franchise['phone']; ?></td>
                                <td><?php echo $franchise['address'];?></td>
                                <td><?php echo $franchise['pin_code']; ?></td>
                                 <td>
                                  <a href="<?php echo base_url('Admin/Franchise/Delete/'.$franchise['id']);?>" target="_blank">Delete</a>/
                                </td>
                            </tr>
                            <?php
                            $i++;
                        }
                        ?>

                    </tbody>
                </table>
                <div class="row">
                  <div class="col-sm-12 col-md-5">
                    <div class="dataTables_info" id="tableView_info" role="status" aria-live="polite">Showing <?php echo ($segament + 1) .' to  '.($i - 1);?> of <?php echo $total_records;?> entries</div>
                  </div>
                  <div class="col-sm-12 col-md-7">
                    <div class="dataTables_paginate paging_simple_numbers" id="tableView_paginate">
                      <?php
                        echo $this->pagination->create_links();
                        ?>
                    </div>
                  </div>
                </div>
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