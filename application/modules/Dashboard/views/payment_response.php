<?php include'header.php' ?>
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Payment Response
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">

                        
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <h2>Status :<?php echo $description['netsTxnMsg'];?></h2>
            <?php
            echo $message;
            ?>
        </div>
    </div>
</div>
<?php include'footer.php' ?>
