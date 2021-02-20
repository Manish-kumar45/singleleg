<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
|  Stripe API Configuration
| -------------------------------------------------------------------
|
| You will get the API keys from Developers panel of the Stripe account
| Login to Stripe account (https://dashboard.stripe.com/)
| and navigate to the Developers » API keys page
|
|  stripe_api_key        	string   Your Stripe API Secret key.
|  stripe_publishable_key	string   Your Stripe API Publishable key.
|  stripe_currency   		string   Currency code.
*/
$config['stripe_api_key']         = 'sk_test_51IIXvKIDgcaozxOB4vOu8AM7c2LzNpyREuzvbVZqDQYB8kK43iHfLR2o6bxMEGvp5qUbqI41PDeqC9U67qoSI00s00uMoWPuSg'; 
$config['stripe_publishable_key'] = 'pk_test_51IIXvKIDgcaozxOBX0pTrI15Gcptd6bEEAYNwcqixBgxFR5ttscvA2KsNhjcXOE0443EhdhyNcDKOqQXPcv8d2SC00hAbL1xOY'; 
$config['stripe_currency']        = 'usd';