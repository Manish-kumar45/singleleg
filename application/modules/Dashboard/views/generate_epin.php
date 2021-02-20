<?php include_once'header.php'; ?>
  <div class="content-wrapper" style="background:white">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">EPin Generate</h1>
            Available Balance Rs.<?php echo number_format($user['income'],2);?>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Withdraw Management</li>
              <li class="breadcrumb-item active">EPin Generate</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="content">
      <div class="container-fluid">
        <div class="row" >
          <div class="col-md-6">
                <?php echo form_open('', array('method' => 'post')); ?>
                    <div class="row">
                        <span class="text-center text-danger">
                            <h3><?php echo $this->session->flashdata('message');?></h3>
                        </span>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>EPins</label>
                                <input type="number" class="form-control" name="epins" placeholder="Epins" value="<?php echo set_value('epins'); ?>"/>
                                <span class="text-danger"><?php echo form_error('epins') ?></span>
                            </div>
                            <div class="form-group">
                                <label>Pin Amount</label>
                                <select class="form-control" name="pin_amount">
                                    <?php
                                    foreach($packages as $key => $package)
                                        echo'<option value="'.$package['price'].'">'.$package['price'].' + (10%)</option>';
                                    ?>
                                </select>
                                <span class="text-danger"><?php echo form_error('pin_amount') ?></span>
                            </div>
                            <div class="form-group">
                                <label>Master Key</label>
                                <input type="text" class="form-control" name="master_key" placeholder="Master Key" value=""/>
                                <span class="text-danger"><?php echo form_error('master_key') ?></span>
                            </div>
                            <div class="form-group">
                                <?php
                                echo form_input(array('type' => 'submit' , 'class' => 'btn btn-success pull-right','name' => 'fundbtn','value' => 'Transfer'));
                                ?>
                            </div>
                        </div>
                    </div>
                <?php echo form_close();?>
          </div>
        </div>
    </div>
</div>
  </div>
<?php include_once'footer.php'; ?>