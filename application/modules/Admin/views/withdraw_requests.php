<?php include'header.php' ?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Withdraw Request </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">All users</li>
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
                <form method="GET" action="">
                  <div class="row">
                    <div class="col-3">
                      <input type="text" name="daterange"  class="form-control float-right" value="" />
                    </div>
                    
                    <div class="col-3">
                      <div class="input-group-append">
                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover" id="">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Amount</th>
                            <th>Payable Amount</th>
                            <th>Status</th>
                            <th style="width:500px">Bank Detail</th>
                            <th>Remark</th>
                            <th>Request Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                         $i = ($segament) + 1;
                        foreach ($requests as $key => $request) {
    //                        pr($request);
                            ?>
                            <tr>
                                <td><?php echo ($key + 1) ?></td>
                                <td><?php echo $request['user_id']; ?></td>
                                <td><?php echo $request['user']['name']; ?></td>
                                <td><?php echo $request['user']['phone']; ?></td>
                                <td><?php echo $request['amount']; ?></td>
                                <td><?php echo $request['payable_amount']; ?></td>
                                <td><?php
                                    if ($request['status'] == 0)
                                        echo'Pending';
                                    elseif ($request['status'] == 1)
                                        echo'Approved';
                                    elseif ($request['status'] == 2)
                                        echo 'Rejected';
                                    ?></td>
                                <td>
                                    <?php 
                                        if ($request['bank']['kyc_status'] == 0)
                                            $kyc_status = 'Not Applied';
                                        elseif ($request['bank']['kyc_status'] == 1)
                                            $kyc_status = 'Pending';
                                        elseif ($request['bank']['kyc_status'] == 2)
                                            $kyc_status = 'Approved';
                                        elseif ($request['bank']['kyc_status'] == 3)
                                            $kyc_status =  'Rejected';
                                        echo 'Bank Name :'. $request['bank']['bank_name'].'<br>';
                                        echo 'Bank Account Number :'. $request['bank']['bank_account_number'].'<br>';
                                        echo 'Account Holder Name :'. $request['bank']['account_holder_name'].'<br>';
                                        echo 'Ifsc Code :'. $request['bank']['ifsc_code'].'<br>';
                                        echo 'Kyc Status :'. $kyc_status.'<br>';
                                    ?>
                                </td>
                                <td><?php echo $request['remark']; ?></td>
                                <td><?php echo $request['created_at']; ?></td>
                                <td><a href="<?php echo base_url('Admin/Withdraw/request/' . $request['id']); ?>" target="_blank">View</a></td>
                            </tr>
                            <?php
                            $i++;
                        }
                        ?>

                    </tbody>
                </table>
                
                <div class="row">
                  <div class="col-sm-12 col-md-5">
                    <div class="dataTables_info" id="tableView_info" role="status" aria-live="polite">Showing <?php echo ($segament + 1) .' to  '.$i;?> of <?php echo $total_records;?> entries</div>
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
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script>
$(function() {
  $('input[name="daterange"]').daterangepicker({
    opens: 'left'
  }, function(start, end, label) {
    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
  });
});
</script>