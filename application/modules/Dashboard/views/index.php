<?php
include_once 'header.php';
$userinfo = userinfo();
date_default_timezone_set('Asia/Kolkata');
?>
<style>
.widget.widget-card .widget-card-cover .cover-bg {

    background: #0a0a0a !important;
    opacity: 0.8 !important;
}

.widget .widget-title,
.widget .widget-title a {
    font-size: 18px !important;

}/*
.info-box {
    box-shadow: -1px 2px 14px -2px rgba(0,0,0,0.75);
    min-height: 180px !important;
    margin-top: 80px;
}
.info-box:hover >span.info-box-icon {
    transition: 1s ease-in-out;
    transform: rotate(45deg);
    z-index: 111;
    width: 70px !important;
    height: 70px;
} 
span.info-box-icon {
    width: 100px !important;
    height: 100px;
    position: absolute;
    top: -55px;
    left: 0;
    right: 0;
    box-shadow: 0px 0px 16px #fff !important;
    margin: auto;
}*/
.info-box .info-box-content{
  margin-top: 40px;
}
.widget-inline-list {
    font-size: 15px !important;

}
.content-header {
    padding: 20px;
    border-bottom: 1px none #efefef ;
    background: #457fbe;
}

.widget.widget-card .widget-card-cover .cover-bg.with-gradient {
    background: -moz-linear-gradient(top, rgba(0, 0, 0, 0) 0, rgba(0, 0, 0, 1) 100%);
    background: -webkit-linear-gradient(top, rgba(0, 0, 0, 0) 0, rgb(88, 189, 173) 100%);
    background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0, rgb(88, 189, 173) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#00000000', endColorstr='#000000', GradientType=0);
}

ul.link {
    margin: 0px auto;
    padding: 0px;
    display: inherit;
}

.social .fb {
    background: url(https://friendzons.com/uploads/fb-share.png) no-repeat;
    padding-left: 40px;
    background-size: 35px;
    list-style: none;
    margin: 0px;
    padding: 6px 40px;
    font-size: 15px;
}

.social .tw {
    background: url(https://friendzons.com/uploads/twiiter-share.png) no-repeat;
    padding-left: 40px;
    background-size: 35px;
    list-style: none;
    margin: 0px;
    padding: 6px 40px;
    font-size: 15px;
}

.social .wa {
    background: url(https://friendzons.com/uploads/whtasppa-share.png) no-repeat;
    padding-left: 40px;
    background-size: 35px;
    list-style: none;
    margin: 0px;
    padding: 6px 40px;
    font-size: 15px;
}

.social .pintrest {
    background: url(https://friendzons.com/uploads/linkdin-share.png) no-repeat;
    padding-left: 40px;
    background-size: 35px;
    list-style: none;
    margin: 0px;
    padding: 6px 40px;
    font-size: 15px;
}

.social {
    margin: 0px auto;
    display: inline-block;
    width: 100%;
    margin-bottom: 10px;
    background: white;
}

ul.link li {
    float: left;
    margin: 0px;
    list-style: none;
}

ul.link li img {
    width: 58px;
    margin-right: 10px;
}
body {
    background-image: none !important;
    background-size: cover;
    font-family: 'Poppins', sans-serif;
}
span.info-box-text {
    font-size: 19px;
    text-transform: uppercase;
}
span.info-box-text {
    font-size: 19px;
    text-transform: uppercase;
    color: white !important;
    font-weight: bold;
}
.info-box .info-box-number {

    color: #fff !important;
    font-size: 19px;
}
.info-box-content {
    text-align: center;
}
.info-box{

  box-shadow: -1px 2px 14px -2px rgba(0,0,0,0.75);
      min-height: 124px;
}
.blink_me {
  animation: blinker 1s linear infinite;
}

@keyframes blinker {
  50% {
    opacity: 0;
  }
}
.card {
    margin-bottom: 24px;
    -webkit-box-shadow: 0 0 13px 0 rgba(236,236,241,.44);
    box-shadow: 0 0 13px 0 rgba(236,236,241,.44);
}
.mini-stat .mini-stat-img {
    width: 58px;
    height: 58px;
    line-height: 58px;
    background: rgba(255,255,255,.15);
    border-radius: 4px;
    text-align: center;
    position: absolute;
    top: -12px;
    display: none;
}
.font-size-16 {
    font-size: 18px!important;
}
.font-weight-medium {
  font-weight: 500;
  color: #fff;
}
.br-btm {
  border-bottom: 1px gray dotted;
}
.mini-stat .mini-stat-img img {
    max-width: 39px;
} 
.bg-img{
  background-image: url('https://orionworld.co.in/uploads/bg-pattern.png') !important;
}
.bg-pink {
    background-color: #e83e8c!important;
}
.text-white-50 {
    color: #fff !important;
}
.bg-success {
    background: linear-gradient(-34deg, #4524c3, #7a8af5)!important;
}
.bg-warning{
  background: linear-gradient(45deg,#226cc5,#6cd975) !important;
}
.epin-body {
    display:inline-block;
}
.card-body {
    text-align: center;
    text-transform: capitalize;
}
.h-130{
  height: 136px;
  border-radius:70px 0px 70px 0px;
  margin-top: 35px;
  background-position: center center !important;
  position: relative;
  overflow: hidden;
}
.card.mini-stat.text-white.h-130::before {
    position: absolute;
    width: 100%;
    height: 100%;
    background-color: #000;
    top: 0;
    left: 0;
    content: '';
    opacity: .7;
}
.prsh-relt {
    position: relative;
}
tr:nth-child(odd) {background:#f2f2f2}
.table thead th {
    background: linear-gradient(180deg,#11cdef,#1171ef)!important;
}
td{
  color: #000;
  font-weight: normal;
}

</style>
<script>
function countdown(element, seconds) {
    // Fetch the display element
    var el = document.getElementById(element).innerHTML;

    // Set the timer
    var interval = setInterval(function() {
        if (seconds <= 0) {
            //(el.innerHTML = "level lapsed");
            $('#'+element).text('level lapsed')

            clearInterval(interval);
            return;
        }
        var time = secondsToHms(seconds)
        $('#'+element).text(time)
        seconds--;
    }, 1000);
}

function secondsToHms(d) {
    d = Number(d);
    var day = Math.floor(d / (3600 * 24));
    var h = Math.floor(d % (3600 * 24) / 3600);
    var m = Math.floor(d % 3600 / 60);
    var s = Math.floor(d % 3600 % 60);

    var dDisplay = day > 0 ? day + (day == 1 ? " day, " : " days, ") : "";
    var hDisplay = h > 0 ? h + (h == 1 ? " hour, " : " hours, ") : "";
    var mDisplay = m > 0 ? m + (m == 1 ? " minute, " : " minutes, ") : "";
    var sDisplay = s > 0 ? s + (s == 1 ? " second" : " seconds") : "";
    var t = dDisplay + hDisplay + mDisplay + sDisplay;
    return t;
    // console.log(t)
}
</script>
<div class="content-wrapper">
    <div>
        <div class="container-fluid">
          <div class="row br-btm m-3">
              <div class="col-md-6">
                  <marquee>
                    Silver Royality Achiever : <?php $i=1; foreach($silverRoyalty as $k1 => $sr){ echo $i.'.'.$sr['user_id'].' ('.$sr['name'].'),'; $i++;}?><br>
                    Gold Royality Achiever : <?php $j=1; foreach($goldRoyalty as $k2 => $gr){ echo $j.'.'.$gr['user_id'].' ('.$gr['name'].'),'; $j++;}?><br>
                    Leadership Achiever : <?php $l=1; foreach($leadershipAchievers as $k3 => $la){ echo $l.'.'.$la['user_id'].' ('.$la['name'].'),'; $l++;}?><br>
                  </marquee>
                  </div>
                  <div class="col-md-6">
                          <p class="opacity-7" id="RefLink102">
                              <a style="background:linear-gradient(135deg,#2f3ea0,#ae342d);float: right; color:white; display: inline-block;margin-top: 8px; font-size:18px; padding: 5px 20px; color:white;margin-bottom:15px;border-radius:10px;"
                                  href="<?php echo base_url('/Dashboard/User/Register/?sponser_id=' . $userinfo->user_id) ?>"
                                  target="_blank">Share Link: (<?php echo ($userinfo->name) ?>) <?php echo ($userinfo->user_id) ?></a>

                                <div class="royalty-achivers">
                                  <?php if($paid_directs['paid_directs'] >= 50){
                                    echo '<label class="btn btn-success btn-sm">You Are Royalty Achiever</label><br>';
                                  }
                                  if($paid_directs['paid_directs'] >= 125){
                                    echo '<label class="btn btn-success btn-sm">You Are Leadership Achiever</label>';
                                  }
                                  ?>
                                </div>

                              <div class="social" style="display:none">
                                  <ul class="link">

                                      <li>
                                          <a onclick="window.open('https://www.facebook.com/sharer.php?u=<?php echo base_url('/Dashboard/User/Register/?sponser_id=' . $userinfo->user_id) ?>', 'sharer', 'toolbar=0,status=0,width=548,height=325');"
                                              target="_parent" href="javascript: void(0)">
                                              <img src="https://friendzons.com/uploads/fb-share.png">
                                          </a>
                                      </li>
                                      <li>
                                          <a onclick="window.open('https://twitter.com/intent/tweet?url=<?php echo base_url('/Dashboard/User/Register/?sponser_id=' . $userinfo->user_id) ?>;original_referer=<?php echo base_url('/Dashboard/User/Register/?sponser_id=' . $userinfo->user_id) ?>', 'sharer', 'toolbar=0,status=0,width=548,height=325');"
                                              target="_parent" href="javascript: void(0)">
                                              <img src="https://friendzons.com/uploads/twiiter-share.png">
                                          </a>
                                      </li>
                                      <li>
                                          <a
                                              href="https://wa.me/?text=7 <?php echo base_url('/Dashboard/User/Register/?sponser_id=' . $userinfo->user_id) ?> Website Link: <?php echo base_url() ?>">
                                              <img src="https://friendzons.com/uploads/whtasppa-share.png">
                                          </a>
                                      </li>
                                      <li>
                                          <a onclick="window.open('https://www.linkedin.com/shareArticle?url=<?php echo base_url('/Dashboard/User/Register/?sponser_id=' . $userinfo->user_id) ?>&amp;source=<?php echo base_url() ?>', 'sharer', 'toolbar=0,status=0,width=548,height=325');"
                                              target="_parent" href="javascript: void(0)">
                                              <img src="https://friendzons.com/uploads/linkdin-share.png">
                                          </a>
                                      </li>
                                  </ul>
                                </div>
                          </p>
                        </div>
              <!-- /.col -->

          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>


    <div class="content">
        <div class="container-fluid">
          <div class="row">
                    <div class="col-xl-2 col-md-6">
                                <div class="card mini-stat text-white h-130" style="background:url('https://wellwishkart.com/uploads/user-1.jpg');">
                                    <div class="card-body">
                                        <div class="mb-0 prsh-relt">
                                            <div class="float-left mini-stat-img mr-4" style="background:linear-gradient(-12deg,#2a57d7 0,#9eeeff 100%) !important;">
                                                <img src="<?php echo base_url('uploads/user01.png');?>" alt="">
                                            </div>
                                              <h5 class="font-size-16 text-uppercase mt-0 text-white-50">USER ID</h5>
                                              <p class="font-weight-medium font-size-24"><?php echo ($userinfo->user_id) ?>
                                                <small>*</small>
                                              </p>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-2 col-md-6">
                                <div class="card mini-stat text-white h-130" style="background:url('https://wellwishkart.com/uploads/user-2.webp');">
                                    <div class="card-body">
                                        <div class="mb-0 prsh-relt">
                                            <div class="float-left mini-stat-img mr-4" style="background:linear-gradient(-12deg,#F88691 0, #FCD3BB 100%) !important;">
                                                <img src="<?php echo base_url('uploads/user02.png');?>" alt="">
                                            </div>
                                              <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Package Status</h5>
                                              <p class="font-weight-medium font-size-24"> <?php echo currency.' '.$userinfo->package_amount; ?>
                                              </p>
                                        </div>

                                    </div>
                                </div>
                            </div>

                               <div class="col-xl-2 col-md-6">
                                <div class="card mini-stat text-white h-130" style="background:url('https://wellwishkart.com/uploads/user-3.png');" >
                                    <div class="card-body">
                                        <div class="mb-0 prsh-relt">
                                            <div class="float-left mini-stat-img mr-4" style="background:linear-gradient(126deg,#7bead0 0,#4BC39D 100%) !important">
                                                <img src="<?php echo base_url('uploads/user03.png');?>" alt="">
                                            </div>
                                              <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Epin (<?php echo $total_pins['sum']; ?>)</h5>
                                              <div class="epin-body">
                                                <p class="mb-0">Used Pins : <?php echo $used_pins['sum']; ?></p>
                                                <p class="mb-0">Transferred : <?php echo $transaferred_pins['sum']; ?></p>
                                                <p class="mb-0">Available : <?php echo $total_pins['sum'] - ($transaferred_pins['sum'] + $used_pins['sum']); ?></p>
                                              </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-2 col-md-6">
                                <div class="card mini-stat text-white h-130" style="background:url('https://wellwishkart.com/uploads/user-4.jpg');" >
                                    <div class="card-body">
                                        <div class="mb-0 prsh-relt">
                                         <div class="float-left mini-stat-img mr-4" style="background:linear-gradient(126deg,#b960e0 0,#a890f5 100%) !important;">
                                                <img src="<?php echo base_url('uploads/user04.png');?>" alt="">
                                            </div>
                                              <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Today Income</h5>
                                              <p class="font-weight-medium font-size-24"><?php echo  currency.' '.number_format($today_income['today_income'],2); ?>
                                  <small>*</small>
                                              </p>
                                              <hr style="margin: 10px 0px;color: white;background: #fff !important;">
                  <a href="<?php echo base_url("Dashboard/User/income_ledgar") ?>" style="color: white;font-weight: normal;text-align:center;display: inherit;"> View Details </a>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-2 col-md-6">
                                <div class="card mini-stat text-white h-130" style="background:url('https://wellwishkart.com/uploads/user-1.jpg');" >
                                    <div class="card-body">
                                        <div class="mb-0 prsh-relt">
                                             <div class="float-left mini-stat-img mr-4" style="background:linear-gradient(to right bottom, #e8962e, #e45131) !important;">
                                                <img src="<?php echo base_url('uploads/user04.png');?>" alt="">
                                            </div> 
                                              <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Total Income</h5>
                                              <p class="font-weight-medium font-size-24"><?php echo  currency.' '. number_format($total_income['total_income'],2) ?>
                                              </p>
                                             
                                        </div>

                                    </div>
                                </div>
                            </div>


                            <div class="col-xl-2 col-md-6 d-none">
                                <div class="card mini-stat text-white h-130" style="background:url('https://wellwishkart.com/uploads/user-3.png');" >
                                    <div class="card-body">
                                        <div class="mb-0 prsh-relt">
                                            <div class="float-left mini-stat-img mr-4" style="background:#f0466b !important;" >
                                                <img src="<?php echo base_url('uploads/user04.png');?>" alt="">
                                            </div> 
                                              <h5 class="font-size-16 text-uppercase mt-0 text-white-50">E-Wallet</h5>
                                              <p class="font-weight-medium font-size-24"> <?php echo  currency.' '.number_format($income_balance['income_balance'],2) ?>
                                              </p>
                                             
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-2 col-md-6">
                                <div class="card mini-stat text-white h-130" style="background:url('https://wellwishkart.com/uploads/user-3.png');" >
                                    <div class="card-body">
                                        <div class="mb-0 prsh-relt">
                                            <div class="float-left mini-stat-img mr-4" style="background:linear-gradient(to right, #21d397 0%, #7450fe 100%) !important;">
                                                <img src="<?php echo base_url('uploads/user04.png');?>" alt="">
                                            </div>
                                             <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Total Withdrawal</h5>
                                              <p class="font-weight-medium font-size-24"><?php echo currency.' '.$bank_transfer['bank_transfer'] ?>
                                              </p>
                                             
                                        </div>

                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-xl-2 col-md-6">
                                <div class="card mini-stat text-white h-130" style="background:url('https://wellwishkart.com/uploads/user-2.webp');">
                                    <div class="card-body">
                                        <div class="mb-0 prsh-relt">
                                       <div class="float-left mini-stat-img mr-4" style="background:linear-gradient(60deg,#ffa726,#fb8c00);">
                                                <img src="<?php echo base_url('uploads/user04.png');?>" alt="">
                                            </div> 
                                              <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Total Directs (<?php echo $free_directs['free_directs'] + $paid_directs['paid_directs']; ?>)</h5>
                                              <p class="font-weight-medium font-size-24"> Paid Direct : <?php echo $paid_directs['paid_directs']; ?> | Unpaid Direct : <?php echo $free_directs['free_directs']; ?>
                                      <small>*</small>
                                              </p>
                                             
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <?php
                    if ($userinfo->paid_status) {
                ?>
                    <div class="col-xl-2 col-md-6">
                        <div class="card mini-stat text-white h-130" style="background:url('https://wellwishkart.com/uploads/user-5.jpg');">
                            <div class="card-body">
                                <div class="mb-0 prsh-relt">
                                  <div class="float-left mini-stat-img mr-4" style="background:linear-gradient(87deg,#5e72e4,#825ee4)!important;">
                                        <img src="<?php echo base_url('uploads/user01.png');?>" alt="">
                                    </div> 
                                        <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Active Downline</h5>
                                        <p class="font-weight-medium font-size-24"> <?php echo $single_leg_downline['single_leg_downline']; ?>
                                        </p>
                                </div>
                            </div>
                        </div>
                    </div>

                            <div class="col-xl-2 col-md-6 d-none">
                                <div class="card mini-stat text-white h-130" style="background:linear-gradient(87deg,#2dce89,#2dcecc)!important">
                                    <div class="card-body">
                                        <div class="mb-0 prsh-relt">
                                           <div class="float-left mini-stat-img mr-4">
                                                <img src="<?php echo base_url('uploads/user01.png');?>" alt="">
                                            </div> 
                                              <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Flushed IDS</h5>
                                              <p class="font-weight-medium font-size-24"> <?php echo $userinfo->waste_count;?>
                                              </p>
                                             
                                        </div>

                                    </div>
                                </div>
                            </div>

                      


                        <?php
                    }
                    ?>
                   
                     <div class="col-xl-2 col-md-6">
                                <div class="card mini-stat text-white h-130" style="background:url('https://wellwishkart.com/uploads/user-6.png');background-position: bottom !important;">
                                    <div class="card-body">
                                        <div class="mb-0 prsh-relt">
                                          <div class="float-left mini-stat-img mr-4" style="background:linear-gradient(87deg,#f5365c,#f56036)!important">
                                                <img src="<?php echo base_url('uploads/user02.png');?>" alt="">
                                            </div> 
                                              <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Current Level</h5>
                                              <p class="font-weight-medium font-size-24"> <?php echo $user['single_leg_status']; ?>
                                              </p>
                                             
                                        </div>

                                    </div>
                                </div>
                            </div>


                            
                                        <div class="col-xl-2 col-md-6">
                                <div class="card mini-stat text-white h-130" style="background:url('https://wellwishkart.com/uploads/user-7.jpg');">
                                    <div class="card-body">
                                        <div class="mb-0 prsh-relt">
                                           <div class="float-left mini-stat-img mr-4" style="background:linear-gradient(87deg,#172b4d,#1a174d)!important;">
                                                <img src="<?php echo base_url('uploads/user03.png');?>" alt="">
                                            </div>
                                              <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Direct INC</h5>
                                              <p class="font-weight-medium font-size-24"> <?php echo currency.' '.$direct_income['direct_income']; ?>
                                              </p>
                                               <hr style="margin: 10px 0px;color: white;background: #fff !important;">
                                          <a href="<?php echo base_url("Dashboard/User/Income/direct_income") ?>" style="color: white;font-weight: normal;text-align:center;display: inherit;"> View Details </a>
                                             
                                        </div>

                                    </div>
                                </div>
                            </div>

                                 

                                    <!-- fix for small devices only -->
                                    <div class="clearfix hidden-md-up"></div>

                                    <div class="col-xl-2 col-md-6">
                                <div class="card mini-stat text-white h-130" style="background:url('https://wellwishkart.com/uploads/user-8.jpg');">
                                    <div class="card-body">
                                        <div class="mb-0 prsh-relt">
                                           <div class="float-left mini-stat-img mr-4" style="background:linear-gradient(316deg, #fc5286, #fbaaa2);">
                                                <img src="<?php echo base_url('uploads/user04.png');?>" alt="">
                                            </div> 
                                              <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Level INC</h5>
                                              <p class="font-weight-medium font-size-24">  <?php echo currency.' '.$level_income['level_income']; ?>
                                              </p>
                                                <hr style="margin: 10px 0px;color: white;background: #fff !important;">
                                              <a href="<?php echo base_url("Dashboard/User/Income/level_income") ?>" style="color: white;font-weight: normal;text-align:center;display: inherit;"> View Details </a>
                                             
                                        </div>

                                    </div>
                                </div>
                            </div>

                              <div class="col-xl-2 col-md-6">
                                <div class="card mini-stat text-white h-130" style="background:url('https://wellwishkart.com/uploads/user-9.jpg');">
                                    <div class="card-body">
                                        <div class="mb-0 prsh-relt">
                                       <div class="float-left mini-stat-img mr-4" style="background:linear-gradient(135deg, #ffc480, #ff763b);">
                                                <img src="<?php echo base_url('uploads/user01.png');?>" alt="">
                                            </div> 
                                              <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Single Leg INC</h5>
                                              <p class="font-weight-medium font-size-24">   <?php echo currency.' '.$single_leg['single_leg']; ?>
                                              </p>
                                                <hr style="margin: 10px 0px;color: white;background: #fff !important;">
                                            <a href="<?php echo base_url("Dashboard/User/Income/single_leg") ?>" style="color: white;font-weight: normal;text-align:center;display: inherit;"> View Details </a>
                                             
                                        </div>

                                    </div>
                                </div>
                            </div>

                              <div class="col-xl-2 col-md-6">
                                <div class="card mini-stat text-white h-130" style="background:url('https://wellwishkart.com/uploads/user-1.jpg');">
                                    <div class="card-body">
                                        <div class="mb-0 prsh-relt">
                                           <div class="float-left mini-stat-img mr-4" style="background:linear-gradient(to bottom, #0e4cfd, #6a8eff);">
                                                <img src="<?php echo base_url('uploads/user02.png');?>" alt="">
                                            </div>
                                              <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Silver Royalty INC</h5>
                                              <p class="font-weight-medium font-size-24"> <?php echo currency.' '.$royalty_income['royalty_income']; ?>
                                              </p>
                                               <hr style="margin: 10px 0px;color: white;background: #fff !important;">
                                            <a href="<?php echo base_url("Dashboard/User/Income/royalty_income") ?>" style="color: white;font-weight: normal;text-align:center;display: inherit;"> View Details </a>
                                             
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-2 col-md-6">
                                <div class="card mini-stat text-white h-130" style="background:url('https://wellwishkart.com/uploads/user-1.jpg');">
                                    <div class="card-body">
                                        <div class="mb-0 prsh-relt">
                                           <div class="float-left mini-stat-img mr-4" style="background:linear-gradient(to bottom, #0e4cfd, #6a8eff);">
                                                <img src="<?php echo base_url('uploads/user02.png');?>" alt="">
                                            </div>
                                              <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Gold Royalty INC</h5>
                                              <p class="font-weight-medium font-size-24"> <?php echo currency.' '.$gold_royalty_income['gold_royalty_income']; ?>
                                              </p>
                                               <hr style="margin: 10px 0px;color: white;background: #fff !important;">
                                            <a href="<?php echo base_url("Dashboard/User/Income/gold_royalty_income") ?>" style="color: white;font-weight: normal;text-align:center;display: inherit;"> View Details </a>
                                             
                                        </div>

                                    </div>
                                </div>
                            </div>
                                   
                                    <div class="col-xl-2 col-md-6">
                                <div class="card mini-stat text-white h-130" style="background:url('https://wellwishkart.com/uploads/user-4.jpg');">
                                    <div class="card-body">
                                        <div class="mb-0 prsh-relt">
                                            <div class="float-left mini-stat-img mr-4"style="background:linear-gradient(87deg,#5e72e4,#825ee4)!important;">
                                                <img src="<?php echo base_url('uploads/user04.png');?>" alt="">
                                            </div> 
                                              <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Leadership INC</h5>
                                              <p class="font-weight-medium font-size-24">  <?php echo currency.' '.$leadership_income['leadership_income']; ?>
                                              </p>
                                            <hr style="margin: 10px 0px;color: white;background: #fff !important;">
                                            <a href="<?php echo base_url("Dashboard/User/Income/leadership_income") ?>" style="color: white;font-weight: normal;text-align:center;display: inherit;"> View Details </a>
                                             
                                        </div>

                                    </div>
                                </div>
                            </div>

                              <div class="col-xl-2 col-md-6">
                                <div class="card mini-stat text-white h-130" style="background:url('https://wellwishkart.com/uploads/user-5.jpg');">
                                    <div class="card-body">
                                        <div class="mb-0 prsh-relt">
                                             <div class="float-left mini-stat-img mr-4" style="background:linear-gradient(87deg,#11cdef,#1171ef)!important;">
                                                <img src="<?php echo base_url('uploads/user04.png');?>" alt="">
                                            </div>
                                            <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Re-Purchase INC</h5>
                                              <p class="font-weight-medium font-size-24"><?php echo currency.' '.$repurchase_income['repurchase_income']; ?>
                                              </p>
                                            <hr style="margin: 10px 0px;color: white;background: #fff !important;">
                                            <a href="<?php echo base_url("Dashboard/User/Income/repurchase_income") ?>" style="color: white;font-weight: normal;text-align:center;display: inherit;"> View Details </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                  

                </div>

        

        

         

     
          <!-- /.col -->
        </div>



        </div>


        <div class="container-fluid">

            <div class="row">
<!--                 <div class="col-lg-12">
                    <h1 style="background:linear-gradient(45deg,#226cc5,#6cd975);
                        padding: 10px;
                        border-radius:10px;
                        color: #fff;
                        font-size: 28px;
                        font-weight:normal;
                        margin-bottom: 30px;">Team Summary</h1>

                </div> -->

                            

                
                <!-- <div class="col-12 col-sm-6 col-md-3" style="display:none">
                  <div class="info-box mb-3" style="background:#7f45f4">
                    <span class="info-box-icon bg-danger elevation-1" style="background:#6637c4 !important"><i class="fas fa-thumbs-up"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">Team Downline</span>
                      <span class="info-box-number"> Total Self Team:  (<?php //echo $team_unpaid['team'] + $team_paid['team'];?>)<br>
                      Free Team : (<?php //echo $team_unpaid['team']; ?>) <br>
                      Paid Team : (<?php //echo $team_paid['team'] ;?>)<br></span>
                    </div>
                  </div>
                </div> -->
                

                                <div class="">
                                    <!-- <div class="col-lg-12">
                                        <h1 style="background:linear-gradient(45deg,#226cc5,#6cd975);
                                            padding: 10px;
                                            border-radius:10px;
                                            color: #fff;
                                            font-size: 28px;
                                            font-weight:normal  ;
                                            margin-bottom: 30px;">Income Summary</h1>

                                    </div> -->

                                    <div class="row">

 
                              </div>

                                </div>


                                <div class="col-lg-12 col-md-12">
                                    <div>
                                        <div class="card-body" style="margin:0px; padding:0px;">
                                            <div class="d-flex justify-content-between">
                                                <h6 class="card-title" style="text-transform: uppercase;font-size: 24px;color: #fff;font-weight: bold;padding:10px 0px;background: linear-gradient(90deg,#0098f0,#00f2c3);width: 100%;text-align: left;margin-bottom: 20px;"><img src="" style="height: 50px;">&nbsp;Plan Presentation</h6>
                                            </div>
                                            <div class="table-responsive" tabindex="1" style="overflow: scroll; outline: none;">
                                                <div>
                                                    <?php
                                                    $legArr = array(
                                                      1 => array('winning_team' => '100', 'direct_sponser' => '1','checkDirect' => '1' ,'amount' => 50, 'days' => 30),
                                                      2 => array('winning_team' => '+200', 'direct_sponser' => '+1','checkDirect' => '2', 'amount' => 50, 'days' => 40),
                                                      3 => array('winning_team' => '+400', 'direct_sponser' => '+1','checkDirect' => '3', 'amount' => 60, 'days' => 55),
                                                      4 => array('winning_team' => '+1000', 'direct_sponser' => '+1','checkDirect' => '4', 'amount' => 80, 'days' => 55),
                                                      5 => array('winning_team' => '+2000', 'direct_sponser' => '+2','checkDirect' => '6', 'amount' => 150, 'days' => 60),
                                                      6 => array('winning_team' => '+3000', 'direct_sponser' => '+2','checkDirect' => '8', 'amount' => 300, 'days' => 60),
                                                      7 => array('winning_team' => '+5000', 'direct_sponser' => '+3','checkDirect' => '11', 'amount' => 400, 'days' => 90),
                                                      8 => array('winning_team' => '+10000', 'direct_sponser' => '+3','checkDirect' => '14', 'amount' => 700, 'days' => 100),
                                                      9 => array('winning_team' => '+25000', 'direct_sponser' => '+5','checkDirect' => '19', 'amount' => 1000, 'days' => 120),
                                                      10 => array('winning_team' => '+50000', 'direct_sponser' => '+5','checkDirect' => '24', 'amount' => 2000, 'days' => 120),
                                                      11 => array('winning_team' => '+100000', 'direct_sponser' => '+6','checkDirect' => '30', 'amount' => 3000, 'days' => 130),
                                                      12 => array('winning_team' => '+200000', 'direct_sponser' => '+6','checkDirect' => '36', 'amount' => 5000, 'days' => 140),
                                                      13 => array('winning_team' => '+400000', 'direct_sponser' => '+8','checkDirect' => '44', 'amount' => 10000, 'days' => 150),
                                                      14 => array('winning_team' => '+600000', 'direct_sponser' => '+8','checkDirect' => '52', 'amount' => 20000, 'days' => 170),
                                                      15 => array('winning_team' => '+800000', 'direct_sponser' => '+8','checkDirect' => '60', 'amount' => 30000, 'days' => 200),
                                                    );
                                                    ?>
                                                    <table class="table table-bordered"  rules="all" border="1" id="ctl00_ContentPlaceHolder1_gdMerchant" style="
    color: #fff;
    font-weight: bold;
    font-size: 18px;">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Team</th>
                                                                <th>Total Direct Sponsor</th>
                                                                <th>Amount</th>
                                                                <th>For Days</th>
                                                                <th>Total Income</th>
                                                                <th>Status</th>
                                                                <!-- <th>Time Left</th> -->
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            foreach ($legArr as $key => $arr) {
                                                                echo'<tr>
                                                                <td>' . $key . '</td>
                                                                <td>' . $arr['winning_team'] . '</td>
                                                                <td> ' . $arr['direct_sponser'] . ' </td>
                                                                <td> ' . $arr['amount'] . ' </td>
                                                                  <td> ' . $arr['days'] . ' </td>

                                                                <td>' . $arr['amount'] * $arr['days']. '</td>';
                                                                if ($user['single_leg_status'] >= $key) {
                                                                    echo'<td> <span style="color:green;">Qualify</span> </td>';
                                                                } else {
                                                                    echo'<td><span style="color:red;">Not Qualify</span> </td>';
                                                                }
                                                                echo '<td class="d-none">';
                                                                    if(is_array($roi)){
                                                                        foreach($roi as $key2 => $r){
                                                                        // pr($r);
                                                                            if($r['level'] == $key){
                                                                                if($user['directs'] < $arr['checkDirect']){
                                                                                    $diff = strtotime('+72 hour', strtotime($r['created_at'])) - strtotime(date('Y-m-d H:i:s'));
                                                                                    echo '<p id="demo'.$key.'"></p>';
                                                                                    echo '<script> countdown("demo'.$key.'",'.$diff.') </script>';
                                                                                }else{
                                                                                    if($r['days'] == 0){
                                                                                        echo 'Level lapsed';
                                                                                    }else{
                                                                                        echo 'Condition cleared';
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                echo '</td>';
                                                                echo'</tr>';
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="clearfix"></div>
        <button type="button" class="btn btn-info btn-lg" style="display:none;" data-toggle="modal" data-target="#myModal" id="mdop">Open Modal</button>
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content text-center">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">
                  <h1 style="    font-size: 22px;
    font-weight: bold;
    line-height: 39px;">Welcome<p style="color:#000;"> to <?php echo title;?>
    <!-- </p><br>Thank You <br> <?php //echo title; ?> -->
    </h1>
                    <img src="<?php echo base_url('uploads/'.$popup['media']);?>" style="max-width:100%" class="img-responsive">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                </div>

            </div>
        </div>


                    <?php $this->load->view('footer'); ?>
                    <script>
                        $(document).on('click', '#upgbtn', function () {
                            var url = '<?php echo base_url("Dashboard/reactivateSpecialAccount") ?>';
                            $.get(url, function (res) {
                                alert(res.message)
                                if (res.success == 1)
                                    location.reload();
                            }, 'json')
                        })
                    </script>
                    <script>
                    $(document).on('click', '#btnCopy', function() {
                        //linkTxt
                        var copyText = document.getElementById("linkTxt");
                        copyText.select();
                        copyText.setSelectionRange(0, 99999)
                        document.execCommand("copy");
                        alert("Copied the text: " + copyText.value);
                    })
                    </script>

                    <script>
                    setTimeout(function(){
                        $('#mdop').click();
                    }, 2000);
                    </script>
