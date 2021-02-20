<?php include'header.php' ?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Achievers</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Achievers</li>
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
                
              </div>
            <!-- </div> -->
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
              <a class="btn btn-default" href="<?php echo base_url('Admin/Achievers/AddAchiever');?>">Create New</a>
                <?php echo $this->session->flashdata('message');?>
                <table class="table table-hover" id="">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Designation</th>
                            <th>Image</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                      $i = ($segament) + 1;
                        foreach ($achievers as $key => $achiever) {
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $achiever['name'] ; ?></td>
                                <td><?php echo $achiever['designation']; ?></td>
                                <td><img src="<?php echo base_url('uploads/'.$achiever['image']);?>"></td>
                                <td><?php echo $achiever['created_at']; ?></td>
                                 <td>
                                  <a href="<?php echo base_url('Admin/Achievers/Delete/'.$achiever['id']);?>" target="_blank">Delete</a>/
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