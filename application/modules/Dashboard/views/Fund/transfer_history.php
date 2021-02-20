
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    <?php echo'Wallet Ledger';?>($<?php echo $wallet_amount['wallet_amount'];?>)
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <div class="dropdown dropdown-inline">
                            <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="la la-download"></i> Export
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">

            <!--begin: Datatable -->
            <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User ID</th>
                        <th>Amount</th>
                        <th>Sender ID</th>
                        <th>Type</th>
                        <th>Remark</th>
                        <th>CreatedAt</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($records as $key => $record) {
                        ?>
                        <tr>
                            <td><?php echo ($key + 1) ?></td>
                            <td><?php echo $record['user_id']; ?></td>
                            <td>Rs.<?php echo $record['amount']; ?></td>
                            <td><?php echo $record['sender_id']; ?></td>
                            <td><?php echo ucwords(str_replace('_',' ',$record['type'])); ?></td>
                            <td><?php echo $record['remark']; ?></td>
                            <td><?php echo $record['created_at']; ?></td>
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
