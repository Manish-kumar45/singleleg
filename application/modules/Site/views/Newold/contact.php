<?php 
    require_once ('header.php')
;?> 

        <!--================Banner Area =================-->
        <section class="banner_area">
            <div class="container">
                <div class="banner_content">
                    <h3>Contact Us</h3>
                </div>
            </div>
        </section>
        <div class="banner_link">
            <div class="container">
                <div class="abnner_link_inner">
                    <a class="active" href="/">Home</a>
                    <a href="#">Contact Us</a>
                </div>
            </div>
        </div>
        <!--================End Banner Area =================-->
        
        <!--================Contact Us Area =================-->
        <section class="contact_us_area">
            <div class="container">
                <div class="contact_us_inner">
                    <div class="section_title">
                        <h2>Feel Free to drop us a Message</h2>
                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium dolore mque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dict eaque ipsa quae ab illo inventore veritatis et quasi architecto.</p>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <form class="contact_us_form" action="#" method="post" id="contactForm" novalidate="novalidate">
                                    <div class="form-group col-md-12">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <textarea class="form-control" name="message" id="message" rows="1" placeholder="Message"></textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <button type="submit" value="submit" class="btn green_submit_btn form-control">submit now</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="our_about_image">
                                <img src="assets/img/contact-us-1.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="contact_us_details">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="c_details_item">
                                <div class="media">
                                    <div class="media-left">
                                        <i class="fa fa-map-marker"></i>
                                    </div>
                                    <div class="media-body">
                                        <p>XXXXXXXX</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="c_details_item">
                                <div class="media">
                                    <div class="media-left">
                                        <i class="fa fa-envelope-o"></i>
                                    </div>
                                    <div class="media-body">
                                        <a href="#">info@orionworld.co.in</a>
                                        <!-- <a href="#">support@consultplus.com</a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="c_details_item">
                                <div class="media">
                                    <div class="media-left">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <div class="media-body">
                                        <a href="#">+91 123 4567 890</a>
                                        <!-- <a href="#">+ 3215 546 8975</a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================End Contact Us Area =================-->
        
        <!--================Map Area =================-->
       <!--  <section class="map_area">
            <div id="mapBox" class="mapBox row m0" 
            data-lat="40.701083" 
            data-lon="-74.1522848" 
            data-zoom="10" 
            data-marker="assets/img/map-marker.png" 
            data-info="PO Box CT16122 Collins Street West, Victoria 8007, Australia."
            data-mlat="40.701083"
            data-mlon="-74.1522848"></div>
        </section> -->
        <!--================End Map Area =================-->
        
        <!--================Get In Consultation Area =================-->
        <section class="get_consult_area">
            <div class="container">
                <div class="pull-left">
                    <h3>Find the Solution That Best Fits Your Business</h3>
                </div>
                <div class="pull-right">
                    <a class="submit_btn" href="#">get free consultation</a>
                </div>
            </div>
        </section>
        <!--================End Get In Consultation Area =================-->



        <?php 
            require_once ('footer.php')
        ;?> 