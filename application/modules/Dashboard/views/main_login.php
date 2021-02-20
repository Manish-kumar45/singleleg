
<div class="color-scheme-01">
    <!DOCTYPE HTML>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name="HandheldFriendly" content="true" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title><?php echo title; ?></title>
            <meta http-equiv='cache-control' content='no-cache'>
            <meta http-equiv='expires' content='0'>
            <meta http-equiv='pragma' content='no-cache'>
            <link href="<?php echo base_url('classic/register/'); ?>css/font-awesome.min.css" rel="stylesheet">
<!--            <link href="<?php // echo base_url('classic/register/');                                     ?>css/bootstrap.min.css" rel="stylesheet" media="screen">-->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
            <link rel="stylesheet" href="<?php echo base_url('classic/register/'); ?>css/all_Jworld.css?v=3.7" media="all">
            <script src="<?php echo base_url('classic/register/'); ?>js/jquery-1.12.1.min.js"></script>
            <script src="<?php echo base_url('classic/register/'); ?>js/jquery-migrate-1.4.min.js"></script>
            <script src="<?php echo base_url('classic/register/'); ?>js/CustomJScript.js?v=2.1"></script>
            <style>
        body{background: url('<?php echo base_url('uploads/bg-1.jpg') ;?>');
            }
            .form-wrapper {
                width:100%;
                margin: 0 auto;
                color: #fff;
                background-size: cover;
                position: relative;
                border-radius:0px 0px 40px 40px;
                margin: 10px;
                background-color: #fff;
            }
                .form-control {
                    padding: 12px 20px;
                    background-color:#fff;
                    border-width: 2px;
                }
                .form-group label {
                    color:#000;
                    font-size: 16px;
                    font-weight: 600;
                    margin-bottom: 13px;
                }
                .form-control::placeholder{
                    color: #000;
                }
                .btn {
                    padding: 10px 15px;

                }
                .btn-gredient{
                    background:#ef6477;  /* fallback for old browsers */
                    background: -webkit-linear-gradient(to right, #0083B0, #00B4DB);  /* Chrome 10-25, Safari 5.1-6 */
                    background:linear-gradient(180deg,#11cdef,#1171ef)!important; /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
                    border: 0;
                    color: #fff;
                    padding: 10px 15px;
                    font-size:20px;
                    line-height: 1.5;
                    border-radius:4px;
                    font-weight: bold;
                    text-transform: uppercase;
                }
                .btn-gredient:focus,
                .btn-gredient:active,
                .btn-gredient:hover{
                    background: #00B4DB;  /* fallback for old browsers */
                    background: -webkit-linear-gradient(to right, #0083B0, #00B4DB);  /* Chrome 10-25, Safari 5.1-6 */
                    background: #007cc0; /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
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
                    color:#ec6e00;
                    font-weight: bold;
                    font-size: 23px;
                    padding: 10px 0px;
                    text-transform: uppercase;
                    background:#fff;
                    border-radius: 4px;
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
                .panel.panel-primary {
                    padding: 0px 20px;
                    position: relative;
                }
                .page-header.text-center {
                    position: relative;
                }
                .page-header img {
                    width: 100%;
                }
                a.forgot-password{
                     color: white;
                    background-color:#f0466b !important;
                    padding: 10px;
                    margin: 10px 0px 0px 0px;
                    text-decoration: none;
                    margin-top: 24px;
                    display: block;
                    text-transform: uppercase;
                    border-radius:4px;
                    font-size: 14px;
                }
                a.register-btn{
                    background:linear-gradient(87deg,#5e72e4,#825ee4)!important;
                    font-weight: 600;
                    color: #fff;
                    text-decoration: none;
                    display:block;
                    padding: 11px;
                    border-radius:4px;
                    text-transform: uppercase;
                    font-size: 14px;
                }
                .page-header {
                    background: #000;
                    padding: 20px;
                }
                @media screen and (max-width: 480px){
                    .btn-gredient{
                        padding: 7px;
                        font-size: 15px;
                    }
                    a.register-btn{
                        font-size: 13px;
                    }
                    a.forgot-password{
                        font-size: 13px;

                        margin-top: 9px;
                    }

                }
            </style>
        </head>
        <body>
            <div id="wrapper" class="joffice">
                <div id="main" class="main">
                    <div class="">


                        <div class="row no-gutters">
                        <div class="col-md-3 col-xl-5"></div>
                            <div class="col-12 col-md-6 col-xl-3 columns">
                                <div class="form-wrapper">
                                    <div class="page-header text-center">
                                         <img src="<?php echo base_url(logo); ?>" style="max-width:260px;padding: 15px;border-radius: 10px;margin: 0;margin-bottom: 20px; ">
                                        <h1 class="page-title">Login Area</h1>

                                    </div>
                                    <div class="panel panel-primary">

                                        <p style="color:red;text-align: center;"><?php echo $message; ?></p>
                                        <?php echo form_open(base_url('Dashboard/User/MainLogin'), array('id' => 'loginForm')); ?>
                                        <form id="loginForm" method="post" action="/login.asp?ReturnURL=">
                                            <div class="panel-body">
                                                <div class="details password-form">

                                                    <div class="form-group">
                                                        <div class="label-area">
                                                            <label>Enter your User ID:</label>
                                                        </div>
                                                        <div class="row-holder">
                                                            <?php
                                                            echo form_input(array(
                                                                'type' => 'text',
                                                                'name' => 'user_id',
                                                                'class' => 'form-control',
                                                                'placeholder' => 'User ID',
                                                                'required' => 'true',
                                                            ));
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="label-area">
                                                            <label>Enter your Strong Password:</label>
                                                        </div>
                                                        <div class="row-holder">
                                                            <?php
                                                            echo form_input(array(
                                                                'type' => 'password',
                                                                'name' => 'password',
                                                                'class' => 'form-control',
                                                                'placeholder' => 'Enter Your StrongPassword',
                                                                'required' => 'true',
                                                            ));
                                                            ?>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <button id="loginBtn" type="submit" class="btn btn-gredient btn-block" name="Submit" value="Login">Sign in </button>
                                                    </div>
                                                    <div class="row">
                                                    <div class="col-12 col-sm-6 col-md-6 form-group text-center" style="color:#000;font-size:15px;">
                                                        Not Member Yet? <a class="register-btn" href="<?php echo base_url(); ?>Dashboard/User/Register">Register Now</a>
                                                    </div>
                                                    <div class="col-12 col-sm-6 col-md-6 form-group" style="text-align:center;">
                                                        <a class="forgot-password" href="<?php echo base_url('Dashboard/forgot_password'); ?>">Forgot password?</a>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <!-- <script type="text/javascript" src="<?php echo base_url('classic/register/'); ?>js/jquery.jqplot.min.js"></script>
                <script type="text/javascript" src="<?php echo base_url('classic/register/'); ?>js/excanvas.min.js"></script>
                <script type="text/javascript" src="<?php echo base_url('classic/register/'); ?>js/jquery.main.js"></script>
                <script type="text/javascript" src="<?php echo base_url('classic/register/'); ?>js/bootstrap.min.js"></script> -->
                <script language="JavaScript" type="text/javascript" src="<?php echo base_url('classic/register/'); ?>js/wz_tooltip.js"></script>
            </div>
        </body>
    </html>
</div>
