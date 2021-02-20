<?php include_once'header.php'; ?>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Create Franchise</h1>
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
            <?php echo form_open('');?>
            <h3 class="text-danger"><?php echo $this->session->flashdata('message'); ?></h3>
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name" value="<?php echo set_value('name');?>" placeholder="Name"/>
                <span class="text-danger"><?php echo form_error('name')?></span>
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="text" class="form-control" name="phone" value="<?php echo set_value('phone');?>" placeholder="Phone"/>
                <span class="text-danger"><?php echo form_error('phone')?></span>
            </div>
            <div class="form-group">
                <label>Address</label>
                <?php
                echo form_textarea(['class'=>'form-control' , 'name' => 'address' , 'placeholder'=>'Address','rows' => '4']);
                ?>
                 <span class="text-danger"><?php echo form_error('address')?></span>
            </div>
            <div class="form-group">
                <label>Pin Code</label>
                <input type="text" class="form-control" name="pin_code" value="<?php echo set_value('pin_code');?>" placeholder="Pin Code"/>
                <span class="text-danger"><?php echo form_error('pin_code')?></span>
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