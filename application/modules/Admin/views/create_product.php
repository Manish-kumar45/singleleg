<?php include'header.php' ?>
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="row">
        <div class="col-md-8">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Create New Product
                            </h3>
                        </div>
                    </div>
                    <?php echo form_open(base_url('Admin/Package/CreateProduct')); ?>
                    <div class="kt-portlet__body">
                        <h2><?php echo $this->session->flashdata('message'); ?></h2>
                        <div class="form-group">
                            <label>Package Title</label>
                            <div></div>
                            <?php
                            echo form_input(array('type' => 'text', 'class' => 'form-control', 'name' => 'title', 'value' => set_value('title')));
                            ?>
                            <span class="text-danger"><?php echo form_error('title'); ?></span>
                        </div>
                        <div class="form-group">
                            <label>BV</label>
                            <div></div>
                            <?php
                            echo form_input(array('type' => 'number', 'class' => 'form-control', 'name' => 'bv', 'value' => set_value('bv')));
                            ?>
                            <span class="text-danger"><?php echo form_error('bv'); ?></span>
                        </div>
                        <div class="form-group">
                            <label>Member Price</label>
                            <div></div>
                            <?php
                            echo form_input(array('type' => 'number', 'class' => 'form-control', 'name' => 'member_price', 'value' => set_value('member_price')));
                            ?>
                            <span class="text-danger"><?php echo form_error('member_price'); ?></span>
                        </div>
                        <div class="form-group">
                            <label>Retail Price</label>
                            <div></div>
                            <?php
                            echo form_input(array('type' => 'number', 'class' => 'form-control', 'name' => 'retail_price', 'value' => set_value('retail_price')));
                            ?>
                            <span class="text-danger"><?php echo form_error('retail_price'); ?></span>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <div></div>
                            <?php
                            echo form_textarea(array('class' => 'form-control', 'name' => 'description', 'value' => set_value('description'),'cols' => 5,'rows' =>3));
                            ?>
                            <span class="text-danger"><?php echo form_error('description'); ?></span>
                        </div>

                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <?php
                            echo form_input(array('type' => 'submit', 'class' => 'btn btn-primary pull-right', 'name' => 'create', 'value' => 'Create'));
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include'footer.php' ?>