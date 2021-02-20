<?php include'header.php' ?>

<script src="<?php echo base_url('classic/assets/plugin');?>/jquery.js"></script>
<script src="<?php echo base_url('classic/assets/plugin');?>/croppie.js"></script>
<link rel="stylesheet" href="<?php echo base_url('classic/assets/plugin');?>/croppie.css"/>
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="row">
        <div class="col-md-8">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Update Product
                            </h3>
                        </div>
                    </div>
                    <?php echo form_open(base_url('Admin/Package/EditProduct/' . $product['id'])); ?>
                    <div class="kt-portlet__body">
                        <h2><?php echo $this->session->flashdata('message'); ?></h2>
                        <div class="form-group">
                            <label>Package Title</label>
                            <div></div>
                            <?php
                            echo form_input(array('type' => 'text', 'class' => 'form-control', 'name' => 'title', 'value' => $product['title']));
                            ?>
                            <span class="text-danger"><?php echo form_error('title'); ?></span>
                        </div>
                        <div class="form-group">
                            <label>BV</label>
                            <div></div>
                            <?php
                            echo form_input(array('type' => 'number', 'class' => 'form-control', 'name' => 'bv', 'value' => $product['bv']));
                            ?>
                            <span class="text-danger"><?php echo form_error('bv'); ?></span>
                        </div>
                        <div class="form-group">
                            <label>Member Price</label>
                            <div></div>
                            <?php
                            echo form_input(array('type' => 'number', 'class' => 'form-control', 'name' => 'member_price', 'value' => $product['member_price']));
                            ?>
                            <span class="text-danger"><?php echo form_error('member_price'); ?></span>
                        </div>
                        <div class="form-group">
                            <label>Retail Price</label>
                            <div></div>
                            <?php
                            echo form_input(array('type' => 'number', 'class' => 'form-control', 'name' => 'retail_price', 'value' => $product['retail_price']));
                            ?>
                            <span class="text-danger"><?php echo form_error('retail_price'); ?></span>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <div></div>
                            <?php
                            echo form_textarea(array('class' => 'form-control', 'name' => 'description', 'value' => $product['description'], 'rows' => 5, 'cols' => 3));
                            ?>
                            <span class="text-danger"><?php echo form_error('description'); ?></span>
                        </div>

                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <?php
                            echo form_input(array('type' => 'submit', 'class' => 'btn btn-primary', 'name' => 'create', 'value' => 'Update'));
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-4 text-center">
                    <div id="upload-demo" style="width:350px;display:none;"></div>
                    <button class="btn btn-success upload-result" type="button" style="display:none;">Upload</button>
                </div>
                <div class="col-md-4" style="padding-top:30px;">
                    <div class="kt-avatar kt-avatar--outline kt-avatar--circle-" id="kt_apps_user_add_avatar">
                        <!--<div class="kt-avatar__holder" style="background-image: url('<?php echo base_url('uploads/1562721505.png'); ?>');"></div>-->
                        <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Choose Product Image">
                            <i class="fa fa-pen"></i>
                            <input type="file" id="upload"  name="profile_avatar" accept=".png, .jpg, .jpeg">
                        </label>
                        <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Cancel avatar">
                            <i class="fa fa-times"></i>
                        </span>
                    </div>
                    <br/>
                </div>
            </div>
            <br><br>
            <?php
            foreach ($product_images as $key => $p_image) {
                ?>
                <div class="img">
                    <img class="img-responsive" src="<?php echo base_url('uploads/'.$p_image['image']); ?>">
                    <a href="<?php echo base_url('Admin/Package/delete_product_image/'.$product['id'].'/'.$p_image['id']);?>" onclick="return confirm('Are you sure?')">Delete</a>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    $uploadCrop = $('#upload-demo').croppie({
        enableExif: true,
        viewport: {
            width: 200,
            height: 200,
            type: 'circle'
        },
        boundary: {
            width: 300,
            height: 300
        }
    });

    $('#upload').on('change', function () {
        $('#upload-demo').css('display', 'block');
        $('.upload-result').css('display', 'block');
        var reader = new FileReader();
        reader.onload = function (e) {
            $uploadCrop.croppie('bind', {
                url: e.target.result
            }).then(function () {
                console.log('jQuery bind complete');
            });

        }
        reader.readAsDataURL(this.files[0]);
    });
    $('.upload-result').on('click', function (ev) {
        $uploadCrop.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function (resp) {
            var formData = {
                "image": resp,
                '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                'product_id': <?php echo $product['id']; ?>
            }
            $.ajax({
                url: '<?php echo base_url('Admin/package/upload_product_image'); ?>',
                type: "POST",
                data: formData,
                success: function (data) {
                    var data = JSON.parse(data);
                    alert(data.message)
                    location.reload();
                }
            });
        });
    });

</script>
<?php include'footer.php' ?>