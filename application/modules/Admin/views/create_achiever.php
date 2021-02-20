<?php include_once'header.php'; ?>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Create Achiever</h1>
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
            <?php echo form_open_multipart('');?>
            <h3 class="text-danger"><?php echo $this->session->flashdata('message'); ?></h3>
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name" value="<?php echo set_value('name');?>" placeholder="Name"/>
                <span class="text-danger"><?php echo form_error('name')?></span>
            </div>
            <div class="form-group">
                <label>Designation</label>
                <input type="text" class="form-control" name="designation" value="<?php echo set_value('designation');?>" placeholder="Designation"/>
                <span class="text-danger"><?php echo form_error('designation')?></span>
            </div>
            <div class="form-group">
                <label>Image</label>
                <input type="file" class="form-control" name="media" value="<?php echo set_value('image');?>" placeholder="Image"/>
                <span class="text-danger"><?php echo form_error('image')?></span>
            </div>
            <div class="form-group">
                <button type="subimt" name="save" class="btn btn-success" />Create</button>
            </div>
            <?php echo form_close();?>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php include_once'footer.php'; ?>