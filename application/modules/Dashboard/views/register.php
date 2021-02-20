<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo title; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <script src="<?php echo base_url('Assets/plugins/jquery/jquery.min.js'); ?>"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    </head>

    <style>
        body{background: url('<?php echo base_url('uploads/register-bg1.jpg') ;?>');
                background-size: cover;
                background-position: center;
        }
        .form-wrapper {
            width:100%;
            margin: 0 auto;
            /*padding: 20px 20px;*/
            background-color:#fff;
            /*box-shadow:0px 0px 16px #fff;*/
            color: #fff;
            border-radius:0px 0px 40px 40px;
            margin: 10px;
        }
        .form-control {
            padding: 12px 20px;
            background-color: #f3f6ff;
        }
        .form-group label {
            color: #000;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 13px;
        }
        .btn {
            padding: 10px 15px;

        }
        .btn-gredient{
            background: #00B4DB;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #0083B0, #00B4DB);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(180deg,#11cdef,#1171ef)!important; /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            border: 0;
            color: #fff;
            padding: 15px 15px;
            font-size: 18px;
            line-height: 1.5;
            border-radius: 4px;
            margin-top: 10px;
            text-transform: uppercase;
            font-weight: bold;
        }
        .btn-gredient:focus,
        .btn-gredient:active,
        .btn-gredient:hover{
            background: #00B4DB;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #0083B0, #00B4DB);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #0083B0, #00B4DB); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            border: 0;
        }
        .forgot-password{
            color: #575f84;
            font-weight: 600;
        }
        .columns{
            min-height: 100vh;display: flex;align-items: center;justify-content: center;
        }
       .page-title {
            background: #ffffff;
            font-size: 23px;
            padding: 10px 0px;
            text-transform: uppercase;
            border-radius: 4px;
            color: #ec6e00;
            font-weight: bold;
        }
        .main-gredient{
            background: #00B4DB;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #0083B0, #00B4DB);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #0083B0, #00B4DB); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        }
        .book-content {
            position: absolute;
            width: 100%;
            height: 100%;
            justify-content: center;
            align-items: center;
            align-content: center;
            display: flex;
            background: rgba(53, 169, 157,0.2);
        }
        .book-content-inner{
            padding: 30px;
            background: #fff;
            max-width: 450px;
        }

        .book-content-inner img {
            max-width: 100%;
            height: auto;
        }

        .clients-wrapper span{
            display: flex;
            align-items: center;
            padding: 15px;
            background-color: #fff;
            height: 100px;
            border-radius: 10px;
            box-shadow: 0 0 2px rgba(0,0,0,0.14), 0 0 2px rgba(0,0,0,0.06);
            margin-bottom: 30px;
        }
        p.small {
            color: #fff;
        }
        .accept a{
            color:#ec6e31;
        }
        .page-header{
            background-color: #000;
            padding: 20px;
        }
        .panel.panel-primary {
            padding: 20px;
        }
    </style>

    <body>
        <div id="wrapper" class="joffice">
            <div id="main" class="main">
                <div class="">


                    <div class="row no-gutters">
                      <div class="col-md-3 col-xl-5"></div>
                        <div class="col-12 col-md-6 col-xl-3 columns">
                            <div class="form-wrapper">
                                <div class="page-header text-center">
                                    <img src="<?php echo base_url(logo); ?>" style="max-width: 260px;padding: 15px;border-radius: 10px;margin: 0;margin-bottom: 20px; ">
                                    <h1 class="page-title">Sign Up Form !</h1>
                                    <p class="small">Join <?php echo title;?> to Start your earning.!</p>
                                </div>

                                <div class="panel panel-primary">
                                    <!-- <h5><?php //echo title;   ?></h5> -->
                                    <span class="text-danger">
                                        <?php echo $this->session->flashdata('error'); ?>
                                    </span>
                                    <?php echo form_open('Dashboard/User/Register?sponser_id=' . $sponser_id, array('id' => 'RegisterForm')); ?>
                                    <div class="form-group">
                                        <label for="Sponser ID">Refferal Code:</label>
                                        <input type="text" class="form-control" id="sponser_id" placeholder="Enter Refferal Code" value="<?php echo $sponser_id; ?>" name="sponser_id" required>
                                        <span class="text-danger"> <?php echo form_error('sponser_id'); ?></span>
                                        <span id="errorMessage" class="text-danger"> </span>
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">Full Name:</label>
                                        <input type="text" class="form-control" placeholder="Enter Your Full Name" name="name" value="<?php echo set_value('name'); ?>" required>
                                        <span class="text-danger"> <?php echo form_error('name'); ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">Mobile Number:</label>
                                        <input type="phone" class="form-control" placeholder="Enter Your Mobile No." name="phone" value="<?php echo set_value('phone'); ?>" required>
                                        <span class="text-danger"> <?php echo form_error('phone'); ?></span>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label for="pwd">Password:</label>
                                        <input type="text" class="form-control" placeholder="Enter Passowrd" name="password" value="<?php //echo set_value('password'); ?>" required>
                                        <span class="text-danger"> <?php //echo form_error('password'); ?></span>
                                    </div> -->
                                    <!-- <div class="form-group">
                                        <label for="pwd">Pan Number:</label>
                                        <input type="phone" class="form-control" placeholder="Enter Your Pan No." name="pan" value="<?php echo set_value('pan'); ?>" required>
                                        <span class="text-danger"> <?php echo form_error('pan'); ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">Aadhar Number:</label>
                                        <input type="phone" class="form-control" placeholder="Enter Aadhar Pan No." name="aadhar" value="<?php echo set_value('aadhar'); ?>" required>
                                        <span class="text-danger"> <?php echo form_error('aadhar'); ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">Father/Husband Name:</label>
                                        <input type="phone" class="form-control" placeholder="Father/Husband Name." name="nominee_name" value="<?php echo set_value('nominee_name'); ?>" required>
                                        <span class="text-danger"> <?php echo form_error('nominee_name'); ?></span>
                                    </div> -->
                                    <div class="accept" style="color:#000;">
                                        <span>
                                            <input id="chTerms" name="chTerms" type="checkbox">
                                        </span>&nbsp;
                                        I have read the   <a style="cursor:pointer; font-size:16px" target="_blank" href="<?php echo base_url('Site/Main/content/terms');?>" target="_blank">Terms &amp; Conditions</a>

                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-gredient btn-block">Submit</button>
                                    </div>

                                    <?php echo form_close(); ?>
                                    <p style="display:none"><a href="<?php echo base_url('Site/Main/Register'); ?>">REGISTER NOW!</a></p>

                                    <p style="text-align:center;color:#000; "> Have Account? <a style="background:#f0466b;color:#fff;padding:10px 20px; border-radius:10px" href="<?php echo base_url('Dashboard/User/login'); ?>">Login Now</a></p>
                                </div>

                            </div>
                        </div>


                    </div>



                </div>
            </div>
        </div>
        <script>
            $(document).on('blur', '#sponser_id', function () {
                check_sponser();
            })
            function check_sponser() {
                var user_id = $('#sponser_id').val();
                if (user_id != '') {
                    var url = '<?php echo base_url("Dashboard/User/get_user/") ?>' + user_id;
                    $.get(url, function (res) {
                        $('#errorMessage').html(res);
                    })
                }
            }
            check_sponser();
            $(document).on('submit', '#RegisterForm', function () {
                if (confirm('Please Check All The Fields Before Submit')) {
                    yourformelement.submit();
                } else {
                    return false;
                }
            })
        </script>
    </body>
</html>
