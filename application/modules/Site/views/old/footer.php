
<footer class="footer-area pt-100 pb-70">
<div class="container">
<div class="row">
<div class="col-lg-4 col-md-5 col-sm-6 col-12">
<div class="footer-widget">
<div class="navbar-brand">
<a href="index.html">
<img src="<?php echo base_url(logo); ?>" alt="image">
</a>
</div>
<p>Welcome to the Profit Venture Concept by Congratulations for having taken a right decision in your life.</p>
<div class="social-link">
<a href="#" class="bg-tertiary" target="_blank">
<i class="fab fa-facebook-f"></i>
</a>
<a href="#" class="bg-success" target="_blank">
<i class="fab fa-tumblr"></i>
</a>
<a href="#" class="bg-danger" target="_blank">
<i class="fab fa-youtube"></i>
</a>
<a href="#" class="bg-info" target="_blank">
<i class="fab fa-linkedin-in"></i>
</a>
<a href="#" class="bg-pink" target="_blank">
<i class="fab fa-instagram"></i>
</a>
</div>
</div>
</div>
<div class="col-lg-4 col-md-5 col-sm-6 col-12">
<div class="footer-widget">
<h5>Quick Links</h5>
<ul class="footer-quick-links">
<li>
<a href="index.php">Home</a>
</li>
<li>
<a href="index.php#about_us">About us</a>
</li>
<li>
<a href="index.php#services">Services</a>
</li>
<li>
<a href="Plan-2.php">Business Plan</a>
</li>
</ul>
</div>
</div>
<div class="col-lg-4 col-md-5 col-sm-6 col-12">
<div class="footer-widget">
<h5>Usefull Links</h5>
<ul class="footer-quick-links">
<li>
<a href="index.php#contact">Contact</a>
</li>
<li>
<a href="<?php echo base_url('Dashboard/User/MainLogin'); ?>">Login</a>
</li>
<li>
<a href="<?php echo base_url('Dashboard/User/Register'); ?>">Register</a>
</li>
</ul>
</div>
</div>

</div>
</div>
</footer>
<div class="copy-right-area">
<div class="container">
<div class="copy-right-content">
<p>
Copyright @ 2020
<a href="index.php" target="_blank">
profitventure.co.in
</a>
</p>
</div>
</div>
</div>
<script data-cfasync="false" src="<?php echo base_url('NewSite/'); ?>assets/js/email-decode.min.js"></script>
<script src="<?php echo base_url('NewSite/'); ?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url('NewSite/'); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url('NewSite/'); ?>assets/js/popper.min.js"></script>
<script src="<?php echo base_url('NewSite/'); ?>assets/js/jquery.magnific-popup.min.js"></script>
<script src="<?php echo base_url('NewSite/'); ?>assets/js/owl.carousel.min.js"></script>
<script src="<?php echo base_url('NewSite/'); ?>assets/js/meanmenu.min.js"></script>
<script src="<?php echo base_url('NewSite/'); ?>assets/js/form-validator.min.js"></script>
<script src="<?php echo base_url('NewSite/'); ?>assets/js/contact-form-script.js"></script>
<script src="<?php echo base_url('NewSite/'); ?>assets/js/jquery.ajaxchimp.min.js"></script>
<script src="<?php echo base_url('NewSite/'); ?>assets/js/main.js"></script>
</body>

</html>



<script type="text/javascript">

let i=2;


$(document).ready(function(){
 var radius = 200;
 var fields = $('.itemDot');
 var container = $('.dotCircle');
 var width = container.width();
radius = width/2.5;

  var height = container.height();
 var angle = 0, step = (2*Math.PI) / fields.length;
 fields.each(function() {
   var x = Math.round(width/2 + radius * Math.cos(angle) - $(this).width()/2);
   var y = Math.round(height/2 + radius * Math.sin(angle) - $(this).height()/2);
   if(window.console) {
     console.log($(this).text(), x, y);
   }

   $(this).css({
     left: x + 'px',
     top: y + 'px'
   });
   angle += step;
 });


 $('.itemDot').click(function(){

   var dataTab= $(this).data("tab");
   $('.itemDot').removeClass('active');
   $(this).addClass('active');
   $('.CirItem').removeClass('active');
   $( '.CirItem'+ dataTab).addClass('active');
   i=dataTab;

   $('.dotCircle').css({
     "transform":"rotate("+(360-(i-1)*36)+"deg)",
     "transition":"2s"
   });
   $('.itemDot').css({
     "transform":"rotate("+((i-1)*36)+"deg)",
     "transition":"1s"
   });


 });

 setInterval(function(){
   var dataTab= $('.itemDot.active').data("tab");
   if(dataTab>6||i>6){
   dataTab=1;
   i=1;
   }
   $('.itemDot').removeClass('active');
   $('[data-tab="'+i+'"]').addClass('active');
   $('.CirItem').removeClass('active');
   $( '.CirItem'+i).addClass('active');
   i++;


   $('.dotCircle').css({
     "transform":"rotate("+(360-(i-2)*36)+"deg)",
     "transition":"2s"
   });
   $('.itemDot').css({
     "transform":"rotate("+((i-2)*36)+"deg)",
     "transition":"1s"
   });

   }, 4000);

});

</script>

<script>
  $(window).load(function(){
     setTimeout(function() {
             $('#myModal').modal('show');
     }, 1000);
         });
</script>
