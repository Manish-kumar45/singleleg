<?php include_once('header.php'); ?>

<!-- banner -->
<section class="banner-1">
    <div class="over">

    </div>
</section>
<!-- //banner -->

<section class="contact">
    <div class="container py-md-4 mt-md-3">

        <div class="inner-sec-w3layouts-agileinfo">
            <div class="contact_grid_right mt-5">
                <div class="row cont">
                    <div class="col-md-6 col-sm-6">
                        <h2>Query with us</h2>
                        <form action="#" method="post">
                            <div class="contact_left_grid">
								<h2><?php echo $this->session->flashdata('message');?></h2>
                                <div class="row">
                                    <?php
									echo form_open();
									?>
                                    <div class="col-md-6">
                                        <input type="text" name="name" value="<?php echo set_value('name');?>"
                                            placeholder="Name" required="">
                                        <span class="text-danger"><?php echo form_error('name');?><span>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="email" name="email" value="<?php echo set_value('email');?>"
                                            placeholder="Email" required="">
                                        <span class="text-danger"><?php echo form_error('email');?><span>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="subject" value="<?php echo set_value('subject');?>"
                                            placeholder="Subject" required="">
                                        <span class="text-danger"><?php echo form_error('subject');?><span>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="phone" placeholder="Phone" required="">
                                        <span class="text-danger"><?php echo form_error('phone');?><span>
                                    </div>
                                    <div class="col-md-12">
                                        <textarea name="message" onfocus="this.value = '';"
                                            onblur="if (this.value == '') {this.value = 'Message...';}"
                                            required="">Message...</textarea>
                                        <input type="submit" value="Submit">
                                        <span class="text-danger"><?php echo form_error('message');?><span>
                                    </div>
                                    <?php echo form_close();?>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6 col-sm-6 cont2">
                        <h2>Contact with us</h2>
                        <ul>
                            <li>
                                <i class="fa fa-home"></i> <span><?php echo address; ?></span>

                                </span>
                                <div class="clearfix"></div>
                            </li>
                            <li>
                                <i class="fa fa-envelope"></i> <span><?php echo email; ?></span>
                                <div class="clearfix"></div>
                            </li>
                            <li>
                                <i class="fa fa-mobile"></i> <span>+91-<?php echo phone; ?></span>
                                <div class="clearfix"></div>
                            </li>
                        </ul>
                        <img src="<?php // echo base_url('uploads/'); ?>pincrd.jpeg" style="width: 100%;" alt="Pan Card">
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>


<?php include_once('footer.php'); ?>
