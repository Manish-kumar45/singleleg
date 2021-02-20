<?php include'header.php' ?>
<div class="content-wrapper" style="min-height: 378px;">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo $header; ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><?php echo $header; ?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="container-fluid">
            <h3 class="text-danger"><?php echo $this->session->flashdata('message');?></h3>
            <div class="row">
                <div class="col-4">
                    <ul class="list-group">
                        <li class="list-group-item active">User Details</li>
                        <li class="list-group-item">User Id : <?php echo $user['user_id']?></li>
                        <li class="list-group-item">User Name : <?php echo $user['name']?></li>
                        <li class="list-group-item">Sponser ID : <?php echo $user['sponser_id']?></li>
                        <li class="list-group-item">Phone : <?php echo $user['phone']?></li>
                        <li class="list-group-item">Email : <?php echo $user['email']?></li>
                        <li class="list-group-item">Package : <?php echo $user['package_amount']?></li>
                        <li class="list-group-item">Activation Date : <?php echo $user['topup_date']?></li>
                    </ul>
                </div>
                <div class="col-4">
                    <ul class="list-group">
                        <li class="list-group-item active">Ticket Details</li>
                        <li class="list-group-item">Subject : <?php echo $ticket['title']?></li>
                        <li class="list-group-item">Message : <?php echo $ticket['message']?></li>
                        
                        <li class="list-group-item">Ticket Status : 
                            <?php 
                            if($ticket['status'] == 0)
                                echo'<span class="text-info">Pending</span>';
                            elseif($ticket['status'] == 1)
                                echo'<span class="text-success">Resolved</span>';
                            ?>
                        </li>
                        <?php
                        if($ticket['status'] == 0){
                            echo '<li class="list-group-item">';
                            echo form_open();
                            echo' Remarks : <textarea name="remark" class="form-control"></textarea><br>';
                            echo'<input type="hidden" name ="status" value="approve">';
                            echo'<button class="btn btn-success">Resolve</button>';
                            echo form_close();
                            echo form_open();
                            echo' Remarks : <textarea name="remark" class="form-control"></textarea><br>';
                             echo'<input type="hidden" name ="status" value="reject">';
                            echo'<button class="btn btn-danger ml-1">Close</button>';
                            echo form_close();
                            echo '</li>';
                        }else{
                            echo '<li class="list-group-item">Remarks :'.$ticket['remark'].'</li>';
                            
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <hr>
        </div>
    </div>
</div>
<?php include'footer.php' ?>
