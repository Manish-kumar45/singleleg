<?php $this->load->view('header'); ?>
<style>
    .kt-invoice-1 .kt-invoice__wrapper .kt-invoice__head .kt-invoice__container .kt-invoice__logo {
    
    padding-top: 50px !important;
}
.kt-invoice-1 .kt-invoice__wrapper .kt-invoice__head .kt-invoice__container .kt-invoice__items {
   
    padding: 30px 0 30px 0 !important;
    
}
    
</style>
<link href="<?php echo base_url('classic/'); ?>assets/css/demo1/pages/general/invoices/invoice-1.css" rel="stylesheet" type="text/css" />
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="kt-portlet">
        <div class="kt-portlet__body kt-portlet__body--fit">
            <div class="kt-invoice-1">
                <div class="kt-invoice__wrapper">
                    <div class="kt-invoice__head" style="background-color: #494a74;">
                        <div class="kt-invoice__container kt-invoice__container--centered">
                            <div class="kt-invoice__logo">
                                <a href="#">
                                    <h1>INVOICE</h1>
                                </a>
                                <a href="#">
                                    <img style="max-width:210px" src="<?php echo base_url('classic/logo.png'); ?>">
                                </a>
                            </div>
                            <span class="kt-invoice__desc">
                                <span>Cecilia Chapman, 711-2880 Nulla St, Mankato</span>
                                <span>Mississippi 96522</span>
                            </span>
                            <div class="kt-invoice__items">
                                <div class="kt-invoice__item">
                                    <span class="kt-invoice__subtitle">DATE</span>
                                    <span class="kt-invoice__text"><?php echo date_format(date_create($order['created_at']), "Y-M-d"); ?></span>
                                </div>
                                <div class="kt-invoice__item">
                                    <span class="kt-invoice__subtitle">INVOICE NO.</span>
                                    <span class="kt-invoice__text">#<?php echo $order_id; ?></span>
                                </div>
                                <div class="kt-invoice__item">
                                    <span class="kt-invoice__subtitle">INVOICE TO.</span>
                                    <span class="kt-invoice__text">
                                        <?php
                                        echo $shipping_details['first_name'] . '<br>';
                                        echo $shipping_details['address_line1'] . '<br>';
                                        echo $shipping_details['address_line2'] . '<br>';
                                        echo $city['name'] . ',' . $state['name'] . '<br>';
                                        echo $country['name'] . '(' . $shipping_details['postal_code'] . ')<br>';
                                        ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-invoice__body kt-invoice__body--centered">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>BV</th>
                                        <th>Total Amount</th>
                                        <th>Total BV</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $total_price = 0;
                                    foreach ($order_details as $key => $detail) {
                                        $total_price = $total_price + ($detail['member_price'] * $detail['quantity']);
                                        echo'<tr>
                                        <td>' . ($key + 1) . '</td>
                                        <td>' . $detail['title'] . '</td>
                                        <td>' . $detail['quantity'] . '</td>
                                        <td>$' . $detail['member_price'] . '</td>
                                        <td>' . $detail['bv'] . '</td>
                                        <td>$' . $detail['member_price'] * $detail['quantity'] . '</td>
                                        <td>' . $detail['bv'] * $detail['quantity'] . '</td>
                                    </tr>';
                                    }
                                    ?>


                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="kt-invoice__footer">
                        <div class="kt-invoice__container kt-invoice__container--centered">
                            <div class="kt-invoice__content">
                                <span>Payment Methid</span>
                                <span><?php echo ucwords(str_replace('_',' ',$order['payment_method'])  );?></span>
                            </div>
                            <div class="kt-invoice__content">
                                <span>TOTAL AMOUNT</span>
                                <span class="kt-invoice__price">$<?php echo $total_price; ?></span>
                                <!--<span>Taxes Included</span>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('footer'); ?>