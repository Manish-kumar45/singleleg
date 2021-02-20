<?php
include_once 'header.php';
$userinfo = userinfo();
?>
<script src="<?php echo base_url('classic/assets/plugin/'); ?>jquery.js"></script>
<script src="<?php echo base_url('classic/assets/plugin/'); ?>croppie.js"></script>
<link rel="stylesheet" href="<?php echo base_url('classic/assets/plugin/'); ?>croppie.css"/>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo $header; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><?php echo $header; ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row p-4 bg-white">
                <div class="col-md-8">
                    <div class="p-4 bg-white">
                        <h2 class="text-center"><?php echo $this->session->flashdata('error'); ?></h2>
                        <?php echo form_open(base_url('Dashboard/User/Profile'), ['id' => 'profileDetails']); ?>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Name</label>
                            <div class="col-lg-9 col-xl-6">
                                <?php
                                echo form_input(['type' => 'text', 'name' => 'name', 'class' => 'form-control', 'value' => $userinfo->name, 'required' => 'required', 'disabled' => 'true']);
                                ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Father/Husband Name</label>
                            <div class="col-lg-9 col-xl-6">
                                <?php
                                echo form_input(['type' => 'text', 'name' => 'last_name', 'class' => 'form-control', 'value' => $userinfo->last_name]);
                                ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Phone</label>
                            <div class="col-lg-9 col-xl-6">
                                <?php
                                echo form_input(['type' => 'text', 'name' => 'phone', 'class' => 'form-control', 'value' => $userinfo->phone]);
                                ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Address</label>
                            <div class="col-lg-9 col-xl-6">
                                <?php
                                $data = array(
                                    'name' => 'address',
                                    'value' => $userinfo->address,
                                    'rows' => '5',
                                    'cols' => '10',
                                    'class' => 'form-control',
                                );

                                echo form_textarea($data);
                                ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Country</label>
                            <div class="col-lg-9 col-xl-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    </div>
                                    <?php
                                    echo form_dropdown('country', $countries, 101, 'class="form-control" id="country"');
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Email</label>
                            <div class="col-lg-9 col-xl-6">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
                                    <?php
                                    echo form_input(['type' => 'email', 'name' => 'email', 'class' => 'form-control', 'value' => $userinfo->email, 'placeholder' => 'Email']);
                                    ?>
                                </div>
                                <input type="hidden" name="form_type" value="profile_form"> 
                                <span class="form-text text-muted">We'll never share your email with anyone else.</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Postal Code</label>
                            <div class="col-lg-9 col-xl-6">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
                                    <?php
                                    echo form_input(['type' => 'number', 'name' => 'postal_code', 'class' => 'form-control', 'value' => $userinfo->postal_code, 'placeholder' => 'Postal Code']);
                                    ?>
                                </div>
                                <input type="hidden" name="form_type" value="profile_form"> 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Txn Pin</label>
                            <div class="col-lg-9 col-xl-6">
                                <?php
                                echo form_input(['type' => 'password', 'name' => 'master_key', 'class' => 'form-control']);
                                ?>
                            </div>
                        </div>
                        <div class="form-group row">

                            <div class="col-lg-9 col-xl-9">
                                <?php
                                echo form_submit('submit', 'Save', 'class="btn btn-primary btn-brand btn-bold pull-right"');
                                echo form_close();
                                ?>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-4">
                    <?php
                    echo '<img src="'.base_url('uploads/'.$userinfo->image).'" class="img-responsive" style="max-width:100%" id="blah" alt="please UPload Your Photo">';
                    echo form_open_multipart();
                    echo'<input type="file" name="userfile" class="form-control" onchange="readURL(this);">';
                    echo'<input type="hidden" name="form_type" value="image_form"> ';
                    echo'<button type="submit" class="btn btn-success">Upload</button>';
                    echo form_close();
                    ?>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once 'footer.php'; ?>
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
