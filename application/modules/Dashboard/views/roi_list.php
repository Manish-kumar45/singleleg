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
                        <li class="breadcrumb-item active">Task</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
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
                                            <td>Started At</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach($records as $key => $record){
                                                echo'<tr>';
                                                echo'<td>'.($key + 1).'</td>';
                                                echo'<td>'.$record['user_id'].'</td>';
                                                echo'<td>'.$record['amount'].'</td>';
                                                echo'<td>'.$record['type'].'</td>';
                                                echo'<td>'.$record['remark'].'</td>';
                                                echo'<td>'.$record['level'].'</td>';
                                                echo'<td>'.$record['days'].'</td>';
                                                echo'<td>'.$record['created_at'].'</td>';
                                                echo'</tr>';
                                            }
                                        ?>
                                    </tbody>    
                                </table>

                                <div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?php echo form_open(base_url('Dashboard/Task/AddVideo'),array('id' => 'videoUpload'));?>
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Videos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <div class="form-group">
                    <label>Video Link</label>
                    <input type="link" name="video_url" name="link" id="videoLink" class="form-control"><br>
                    <iframe width="100%" height="315" id="frameSrc" src="https://www.youtube.com/embed/w-DlkqpDVTg" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
            <?php echo form_close();?>
        </div>
    </div>
</div>
<?php include_once'footer.php'; ?>
<script>
$(document).on('change','#videoLink',function(){
    var url = 'https://www.youtube.com/embed/'+$(this).val();
    $('#frameSrc').attr('src',url);
})
$(document).on('submit','#videoUpload',function(e){
    e.preventDefault();
    var url = $(this).attr('action');
    var formData = $(this).serialize();
    var t = $(this)
    $.post(url,formData,function(res){
        t.append('<input type="hidden" name="'+res.token_name+'" value="'+res.token_value+'" style="display:none;">')
        alert(res.message)
        if(res.success == 1)
            location.reload();
    },'json')
})
$(document).on('click','.dltvideo',function(){
    var video_id = $(this).data('id');
    var url = '<?php echo base_url("Dashboard/Task/DeleteVideo/")?>'+video_id;
    $.get(url,function(res){
        alert(res.message)
        if(res.success == 1)
            location.reload();
    },'json')
})
</script>