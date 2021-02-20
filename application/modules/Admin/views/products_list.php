<?php include'header.php' ?>
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Products List
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <div class="dropdown dropdown-inline">
                            <a href="<?php echo base_url('Admin/Package/CreateProduct');?>" class="btn btn-success btn-icon-sm">
                                <i class="la la-add"></i> Create New
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title text-danger">
                    <?php echo $this->session->flashdata('message');?>
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">

            <!--begin: Datatable -->
            <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>BV</th>
                        <th>Member Price</th>
                        <th>Retail Price</th>
                        <th>CreatedAt</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($products as $key => $product) {
                        ?>
                        <tr>
                            <td><?php echo ($key + 1)?></td>
                            <td><?php echo $product['title'];?></td>
                            <td><?php echo $product['bv'];?></td>
                            <td>$<?php echo $product['member_price'];?></td>
                            <td>$<?php echo $product['retail_price'];?></td>
                            <td><?php echo $product['created_at'];?></td>
                            <td><a href="<?php echo base_url('Admin/package/EditProduct/'.$product['id']);?>">Edit</a> |
                                <a href="<?php echo base_url('Admin/package/DeleteProduct/'.$product['id']);?>"  onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>

                </tbody>
            </table>

            <!--end: Datatable -->
        </div>
    </div>
</div>
<?php include'footer.php' ?>