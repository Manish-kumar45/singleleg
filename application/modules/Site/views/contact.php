<?php 
    require_once 'header.php' 
;?>
<style>

.main-header {
    min-height: 112px;
}
    .main-header-area .header-logo img {
    width: 150px;
}
.breadcrumbs-area {
    background: #74787b;
}


    </style>
    <!-- Breadcrumb Area Start Here -->
    <div class="breadcrumbs-area position-relative mb-text-p">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="breadcrumb-content position-relative section-content">
                        <h3 class="title text-white">Contact Us</h3>
                        <ul class="text-white">
                            <li><a href="/">Home</a></li>
                            <li>Contact us</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End Here -->
    <!-- Contact Information And Title Area Start -->
    <div class="contact-info mt-5 pt-90 pb-90">
        <div class="container">
            <div class="row mb-n10">
                <div class="col-md-4 mb-10" data-aos="fade-up" data-aos-delay="100">
                    <div class="info">
                        <div class="info-icon">
                            <i class="fa fa-map-marker"></i>
                        </div>
                        <div class="info-content">
                            <h4 class="title">Our Locations</h4>
                            <span class="info-text"> <?php echo address ;?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-10" data-aos="fade-up" data-aos-delay="300">
                    <div class="info">
                        <div class="info-icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="info-content">
                            <h4 class="title">Give Us A Call</h4>
                            <span class="info-text"> (+91) <?php echo phone ;?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-10" data-aos="fade-up" data-aos-delay="600">
                    <div class="info">
                        <div class="info-icon">
                            <i class="fa fa-envelope-o"></i>
                        </div>
                        <div class="info-content">
                            <h4 class="title">Help Desk</h4>
                            <span class="info-text">
                            <a href="#"><?php echo email ;?></a>
                           
                        </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact Information End -->
  

    <!-- Contact Form Start -->
    <div class="contact-form-area bg-light pt-90 pb-90" data-aos="fade-up" data-aos-delay="100">
        <div class="container">
            <div class="row">
                <div class="offset-lg-2 col-lg-8">
                    <div class="contact-form">
                        <form action="https://htmlmail.hasthemes.com/rezaul/corporate.php" id="contact-form" method="post">
                            <div class="row">
                                <div class="col-md-6 col-12 mb-6">
                                    <input class="input-item" type="text" placeholder="Your Name *" name="name">
                                </div>
                                <div class="col-md-6 col-12 mb-6">
                                    <input class="input-item" type="email" placeholder="Email *" name="email">
                                </div>
                                <div class="col-12 mb-6">
                                    <input class="input-item" type="text" placeholder="Subject *" name="subject">
                                </div>
                                <div class="col-12 mb-6">
                                    <textarea class="textarea-item" name="message" placeholder="Message"></textarea>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary btn-hover-dark">Submit</button>
                                </div>
                            </div>
                        </form>
                        <p class="form-messege"></p>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Contact Form End -->
    
    <?php 
        require_once 'footer.php' 
    ;?>