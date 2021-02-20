<?php include_once'header.php'; ?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo $header;?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><?php echo $header;?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">

            <form method="GET" action="">
                <div class="row">
                    <div class="col-3">
                    <select class="form-control" name="type">
                        <option value="user_id" <?php echo $type == 'user_id' ? 'selected' : '';?>>User ID</option>
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
                </div>
            </form>
            <div class="row">
               <div class="col-md-12">
                    <div class="bg-white p-4 mb-4">
                        <div class="table-responsive mt-4">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>User ID</td>
                                        <td>Amount</td>
                                        <td>Type</td>
                                        <td>Remark</td>
                                        <td>Level</td>
                                        <td>Days</td>
                                        <td>Action</td>
                                        <td>Started At</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                     $i = ($segament) + 1;
                                        foreach($records as $key => $record){
                                            // pr($video);
                                            echo'<tr>';
                                            echo'<td>'.$i.'</td>';
                                            echo'<td>'.$record['user_id'].'</td>';
                                            echo'<td>'.$record['amount'].'</td>';
                                            echo'<td>'.$record['type'].'</td>';
                                            echo'<td>'.$record['remark'].'</td>';
                                            echo'<td>'.$record['level'].'</td>';
                                            echo'<td>'.$record['days'].'</td>';
                                            echo'<td>'.($record['days'] > 0 ? '<button type="button" class="btn btn-success updbtn" data-id="'.$record['id'].'">Stop ROI</button>' : '').'</td>';
                                            echo'<td>'.$record['created_at'].'</td>';
                                            echo'</tr>';
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
                        <div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once'footer.php'; ?>
<script>
$(document).on('click','.updbtn',function(){
    var roi_id = $(this).data('id');
    var url = '<?php echo base_url("Admin/Task/UpdateRoiStatus/")?>'+roi_id;
    $.get(url,function(res){
        alert(res.message)
        if(res.success == 1)
            location.reload();
    },'json')
})
</script>