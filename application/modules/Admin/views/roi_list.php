<?php include'header.php' ?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Roi Setup</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Roi Setup</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            New Roi Details
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <h3><?php echo $this->session->flashdata('message');?></h3>
                            <?php echo form_open();?>
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="text" name="amount" class="form-control"/>
                                    <label class="text-danger"><?php echo form_error('amount');?></label>
                                </div>
                                <div class="form-group">
                                    <label>Level</label>
                                    <input type="text" name="level" class="form-control"/>
                                    <label class="text-danger"><?php echo form_error('level');?></label>
                                </div>
                                <div class="form-group">
                                    <label>Days</label>
                                    <input type="text" name="days" class="form-control"/>
                                    <label class="text-danger"><?php echo form_error('days');?></label>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success pull-right">Add</button>
                                </div>
                            <?php echo form_close();?>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            Roi Details
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Amount</th>
                                            <th>Level</th>
                                            <th>days</th>
                                            <th>date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach($rois as $key => $roi){
                                            echo'<tr>';
                                            echo'<td>'.($key + 1).'</td>';
                                            echo'<td>'.$roi['amount'].'</td>';
                                            echo'<td>'.$roi['level'].'</td>';
                                            echo'<td>'.$roi['days'].'</td>';
                                            echo'<td>'.$roi['created_at'].'</td>';
                                            echo'</tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
<?php include'footer.php' ?>