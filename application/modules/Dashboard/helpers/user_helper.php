<?php

if (!function_exists('pr')) {

    function pr($array, $die = false) {
        echo'<pre>';
        print_r($array);
        echo'</pre>';
        if ($die)
            die();
    }

}
if (!function_exists('is_logged_in')) {

//    protected $CI;

    function is_logged_in() {
        $ci = & get_instance();
        $ci->load->library('session');
        if (isset($ci->session->userdata['user_id'])) {
            return true;
        } else {
            return false;
        }
    }

}
if (!function_exists('userinfo')) {

    function userinfo() {
        $ci = & get_instance();
        $ci->load->model('user_model');
        $userdetails = $ci->user_model->get_single_object('tbl_users', array('user_id' => $ci->session->userdata['user_id']), '*');
        return $userdetails;
    }

}
if (!function_exists('pool_count')) {

    function pool_count() {
        $ci = & get_instance();
        $ci->load->model('user_model');
        $pool_count = $ci->user_model->get_single_object('tbl_pool', array('user_id' => $ci->session->userdata['user_id']), 'ifnull(count(id),0) as pool_count');
        return $pool_count;
    }

}
if (!function_exists('calculate_rank')) {

    function calculate_rank($directs) {
        if($directs >= 100)
            $rank = 'Diamond';
        elseif($directs >= 50)
            $rank = 'Emerald';
        elseif($directs >= 25)
            $rank = 'Topaz';
        elseif($directs >= 20)
            $rank = 'Pearl';
        elseif($directs >= 15)
            $rank = 'Gold';
        elseif($directs >= 10)
            $rank = 'Silver';
        elseif($directs >= 5)
            $rank = 'Star';
        else
            $rank = 'Associate';

        return $rank;
    }
}
if (!function_exists('calculate_package')) {

    function calculate_package($package_id) {
        if($package_id == 1)
            $package = '3600';
        elseif($package_id == 2)
            $package = '1400';

        return $package;
    }
}

if (!function_exists('notify_user')) {

    function notify_user($user_id , $message) {
        $ci = & get_instance();
        $ci->load->model('user_model');
        $user = $ci->user_model->get_single_object('tbl_users', array('user_id' => $user_id), 'name,phone,email');
        $smsCount = $ci->user_model->get_single_record('tbl_sms_counter',array(),'count(id) as record');
        if($smsCount['record'] <= 5000){
            /*for sms */
            $key = "a08f1ade94XX";//"a08f1ade94XX";
            $userkey = "gniweb2";
            $senderid = "GNIMLM";
            $baseurl = "sms.gniwebsolutions.com/submitsms.jsp?";

            $msg = urlencode($message);
            $url = $baseurl . 'user=' . $userkey . '&&key=' . $key . '&&mobile=' . $user->phone . '&&senderid=' . $senderid . '&&message=' . $msg . '&&accusage=1';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            $data = curl_exec($ch);
            curl_close($ch);
            $sms_data = array('user_id' => $user_id , 'message' => $msg , 'response' => $data);
            $ci->user_model->add('tbl_sms_counter', $sms_data);
            /*for sms */
        }
    }

}
if (!function_exists('tax')) {

    function tax() {
        $ci = & get_instance();
        $ci->load->model('user_model');
        $tax = $ci->user_model->get_single_object('tbl_tax', array('id' => 1), '*');
        return $tax->tax;
    }

}
if (!function_exists('cart_items')) {

    function cart_items() {
        $ci = & get_instance();
        $ci->load->model('Shopping_model');
        $userdetails = $ci->Shopping_model->cart_items($ci->session->userdata['user_id']);
        return $userdetails;
    }

}
if (!function_exists('tree_img')) {

    function tree_img($commision = false) {
        if ($commision == false) {
            $img = base_url('classic/assets/images/free.jpg');
        } elseif ($commision == 20) {
            $img = base_url('classic/assets/images/package20.png');
        } elseif ($commision == 22) {
            $img = base_url('classic/assets/images/package22.png');
        } elseif ($commision == 24) {
            $img = base_url('classic/assets/images/package24.png');
        } elseif ($commision == 28) {
            $img = base_url('classic/assets/images/package28.png');
        }
        return $img;
    }

}


if (!function_exists('get_income_name')) {

    function get_income_name($income_name) {
        $incomes = array(
            'direct_income'=> 'Direct Income',
            'level_income'=> 'Level Income',
            'single_leg'=> 'Single Leg Income',
            'royalty_income'=> 'Silver Royalty Income',
            'gold_royalty_income'=> 'Gold Royalty Income',
            'repurchase_income'=> 'Repurchase Income',
            'leadership_income'=> 'Leadership Income',
            'withdraw_request'=> 'Withdraw Request',
            'bank_transfer'=> 'Bank Withdrawal',
            'pin_generation' => 'Pin Generation',
            'admin_amount' => 'Admin AMount',
        );
        // return array_search($income_name, $incomes);
        return $incomes[$income_name];
    }

}
if (!function_exists('incomes')) {

    function incomes() {
        $incomes = array(
            'direct_income'=> 'Direct Income',
            'level_income'=> 'Level Income',
            'single_leg'=> 'Single Leg Income',
            'royalty_income'=> 'Silver Royalty Income',
            'gold_royalty_income'=> 'Gold Royalty Income',
            'repurchase_income'=> 'Repurchase Income',
            'leadership_income'=> 'Leadership Income',
        );
        //matching bonus
        // return array_search($income_name, $incomes);
        return $incomes;
    }

}


function country_dropdown($name, $id, $class, $selected_country, $top_countries = array(), $all, $selection = NULL, $show_all = TRUE) {
    // Getting the array of countries from the config file
    $countries = config_item('country_list');
    $html = "<select name='{$name}' id='{$id}' class='{$class}'>";
    $selected = NULL;
    if (in_array($selection, $top_countries)) {
        $top_selection = $selection;
        $all_selection = NULL;
    } else {
        $top_selection = NULL;
        $all_selection = $selection;
    }
    if (!empty($selected_country) && $selected_country != 'all' && $selected_country != 'select') {
        $html .= "<optgroup label='Selected Country'>";
        if ($selected_country === $top_selection) {
            $selected = "SELECTED";
        }
        $html .= "<option value='{$selected_country}'{$selected}>{$countries[$selected_country]}</option>";
        $selected = NULL;
        $html .= "</optgroup>";
    } else if ($selected_country == 'all') {
        $html .= "<optgroup label='Selected Country'>";
        if ($selected_country === $top_selection) {
            $selected = "SELECTED";
        }
        $html .= "<option value='all'>All</option>";
        $selected = NULL;
        $html .= "</optgroup>";
    } else if ($selected_country == 'select') {
        $html .= "<optgroup label='Selected Country'>";
        if ($selected_country === $top_selection) {
            $selected = "SELECTED";
        }
        $html .= "<option value='select'>Select</option>";
        $selected = NULL;
        $html .= "</optgroup>";
    }
    if (!empty($all) && $all == 'all' && $selected_country != 'all') {
        $html .= "<option value='all'>All</option>";
        $selected = NULL;
    }
    if (!empty($all) && $all == 'select' && $selected_country != 'select') {
        $html .= "<option value='select'>Select</option>";
        $selected = NULL;
    }

    if (!empty($top_countries)) {
        $html .= "<optgroup label='Top Countries'>";
        foreach ($top_countries as $value) {
            if (array_key_exists($value, $countries)) {
                if ($value === $top_selection) {
                    $selected = "SELECTED";
                }
                $html .= "<option value='{$value}'{$selected}>{$countries[$value]}</option>";
                $selected = NULL;
            }
        }
        $html .= "</optgroup>";
    }
    if ($show_all) {
        $html .= "<optgroup label='All Countries'>";
        foreach ($countries as $key => $country) {
            if ($key === $all_selection) {
                $selected = "SELECTED";
            }
            $html .= "<option value='{$key}'{$selected}>{$country}</option>";
            $selected = NULL;
        }
        $html .= "</optgroup>";
    }

    $html .= "</select>";
    return $html;
}
