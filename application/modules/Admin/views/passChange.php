<?php include_once'header.php'; ?>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Password Manager</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <?php echo form_open('',array('id' => 'walletForm'));?>
            <h3 class="text-danger"><?php echo $this->session->flashdata('message'); ?></h3>
            <div class="form-group">
                <label>Old Password</label>
                <input type="password" class="form-control" name="old_password" value="<?php echo set_value('old_password');?>" placeholder="News Title"/>
                <span class="text-danger"><?php echo form_error('old_password')?></span>
                <span id="errorMessage"></span>
            </div>
            <div class="form-group">
                <label>New Password</label>
                <input type="password" class="form-control" name="new_password" value="<?php echo set_value('new_password');?>" placeholder="News Title"/>
                <span class="text-danger"><?php echo form_error('new_password')?></span>
                <span id="errorMessage"></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" class="form-control" name="confirm_password" value="<?php echo set_value('confirm_password');?>" placeholder="News Title"/>
                <span class="text-danger"><?php echo form_error('confirm_password')?></span>
                <span id="errorMessage"></span>
            </div>
            <div class="form-group">
                <button type="subimt" name="save" class="btn btn-success" />Update Password</button>
            </div>
            <?php echo form_close();?>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php include_once'footer.php'; ?>
<script>
  $(document).on('blur','#user_id',function(){
    var user_id = $(this).val();
    var url  = '<?php echo base_url("Admin/Management/get_user/")?>'+user_id;
    $.get(url,function(res){
      $('#errorMessage').html(res);
    })
  })
  $(document).on('submit','#walletForm',function(){
      if (confirm('Do you want to Update Password')) {
           yourformelement.submit();
       } else {
           return false;
       }
  })
</script>