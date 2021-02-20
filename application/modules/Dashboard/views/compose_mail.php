<?php include_once'header.php'; ?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Compose Mail</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">Support</li>
                        <li class="breadcrumb-item active">Compose Mail</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="container-fluid">

            <?php echo form_open('', array('id' => 'composeMail')); ?>
            <h3 class="text-danger"><?php echo $this->session->flashdata('message'); ?></h3>
            <div class="form-group">
                <label>Topic</label>
                <select class="form-control" name="title">
                    <option>General</option>
                    <option>Withdraw</option>
                    <option>Topup</option>
                </select>
            </div>
            <div class="form-group">
                <label>Message</label>
                <textarea class="form-control" name="message" required></textarea>
            </div>
            <div class="form-group">
                <button type="subimt" name="save" class="btn btn-success" />Send</button>
            </div>
            <?php echo form_close(); ?>

        </div>
    </div>
</div>
<?php include_once'footer.php'; ?>