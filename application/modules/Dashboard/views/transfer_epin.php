<?php include_once'header.php'; ?>
<div class="content-wrapper" style="background:white">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Transfer Epins</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">Pins Management</li>
                        <li class="breadcrumb-item active">Transfer Epins</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row" >
                <div class="col-md-6">
                    <?php echo form_open('', array('id' => 'TopUpForm')); ?>
                    <span class="text-danger"><?php echo $this->session->flashdata('message'); ?></span>
                    <div class="form-group">
                        <label style="font-size:20px; color:red">Available Pins ( <?php echo $available_epins['total_epins']; ?>)</label><br>
                    </div>
                    <div class="form-group">
                        <label>EPins</label>
                        <input type="number" class="form-control" name="epins" placeholder="Epins" value="<?php echo set_value('epins'); ?>"/>
                        <span class="text-danger"><?php echo form_error('epins') ?></span>
                    </div>
                    <div class="form-group">
                        <label>User ID</label>
                        <input type="text" class="form-control" name="user_id" id="user_id" placeholder="User ID" value=""/>
                        <span class="text-danger" id="errorMessage"><?php echo form_error('user_id') ?></span>
                    </div>
                    <div class="form-group">
                        <label>Master Key</label>
                        <input type="text" class="form-control" name="master_key" placeholder="Master Key" value=""/>
                        <span class="text-danger"><?php echo form_error('master_key') ?></span>
                    </div>
                    <div class="form-group">
                        <button type="subimt" name="save" class="btn btn-success" />Transfer</button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once'footer.php'; ?>
<script>
    $(document).on('submit', '#TopUpForm', function () {
        if (confirm('Are You Sure To Transfer These Epins')) {
            yourformelement.submit();
        } else {
            return false;
        }
    })

    $(document).on('blur','#user_id',function(){
        var user_id = $(this).val();
        if (user_id != '') {
            var url = '<?php echo base_url()?>Dashboard/User/get_user/' + user_id;
            $.get(url, function (res) {
                $('#errorMessage').html(res);
            })
        }
    })
</script>
