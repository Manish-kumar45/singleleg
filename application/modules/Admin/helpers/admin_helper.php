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
if (!function_exists('is_admin')) {

    function is_admin() {
        $ci = & get_instance();
        $ci->load->library('session');
        if (isset($ci->session->userdata['role']) && $ci->session->userdata['role'] == 'ADMIN' && !empty($ci->session->userdata['secure_id'])) {
            if($ci->session->userdata['secure_admin_id'] == 'secure_admin2'){
                return true;
            }
        } else {
            return false;
        }
    }

}
function calculate_team($directs){
    $legArr = array(
        0 => array('winning_team' => 65, 'direct_sponser' => 0, 'amount' => 30, 'days' => 50 ,'new_team' => 65),
        1 => array('winning_team' => 330, 'direct_sponser' => 2, 'amount' => 40, 'days' => 50,'new_team' => 200),
        2 => array('winning_team' => 830, 'direct_sponser' => 3, 'amount' => 50, 'days' => 50,'new_team' => 235),
        3 => array('winning_team' => 1830, 'direct_sponser' => 4, 'amount' => 100, 'days' => 50,'new_team' => 500),
        4 => array('winning_team' => 3830, 'direct_sponser' => 5, 'amount' => 150, 'days' => 50,'new_team' => 1000),
        5 => array('winning_team' => 2000, 'direct_sponser' => 5, 'amount' => 150, 'days' => 50,'new_team' => 2000),
        6 => array('winning_team' => 2000, 'direct_sponser' => 7, 'amount' => 250, 'days' => 60,'new_team' => 2000),
        7 => array('winning_team' => 5000, 'direct_sponser' => 7, 'amount' => 250, 'days' => 60,'new_team' => 4000),
        8 => array('winning_team' => 10000, 'direct_sponser' => 9, 'amount' => 400, 'days' => 60),
        9 => array('winning_team' => 10000, 'direct_sponser' => 9, 'amount' => 400, 'days' => 60),
        12 => array('winning_team' => 20000, 'direct_sponser' =>12, 'amount' => 700, 'days' => 60),
        17 => array('winning_team' => 50000, 'direct_sponser' => 17, 'amount' => 1000, 'days' => 60),
        22 => array('winning_team' => 100000, 'direct_sponser' => 22, 'amount' => 1500, 'days' => 60),
        30 => array('winning_team' => 200000, 'direct_sponser' => 30, 'amount' => 2000, 'days' => 90),
        38 => array('winning_team' => 300000, 'direct_sponser' => 38, 'amount' => 2500, 'days' => 90),
        46 => array('winning_team' => 500000, 'direct_sponser' => 46, 'amount' => 3000, 'days' => 90), 
        54 => array('winning_team' => 1000000, 'direct_sponser' => 54, 'amount' => 5000, 'days' => 90),
      );
    return $legArr[$directs]['winning_team'];
}
// if (!function_exists('pool_count')) {

//     function pool_count() {
//         $ci = & get_instance();
//         $ci->load->model('Main_model');
//         $pool_count = $ci->Main_model->get_single_record('tbl_pool', array(), 'max(pool_level) as pool_count');
//         return $pool_count;
//     }

// }
// if (!function_exists('calculate_rank')) {

//     function calculate_rank($directs) {
//         if($directs >= 100)
//             $rank = 'Diamond';
//         elseif($directs >= 50)
//             $rank = 'Emerald';
//         elseif($directs >= 25)
//             $rank = 'Topaz';
//         elseif($directs >= 20)
//             $rank = 'Pearl';
//         elseif($directs >= 15)
//             $rank = 'Gold';
//         elseif($directs >= 10)
//             $rank = 'Silver';
//         elseif($directs >= 5)
//             $rank = 'Star';
//         else
//             $rank = 'Associate';

//         return $rank;
//     }
// }
// if (!function_exists('calculate_package')) {

//     function calculate_package($package_id) {
//         if($package_id == 1)
//             $package = '3600';
//         elseif($package_id == 2)
//             $package = '1400';
//         else
//             $package = 'Free';
//         return $package;
//     }
// }


if (!function_exists('get_income_name')) {

    function get_income_name($income_name) {
        $incomes = array(
            'direct_income'=> 'Direct Income',
            'level_income'=> 'Level Income',
            'single_leg' => 'Single Leg',
            'repurchase_income'=> 'Repurchase Income',
            'royalty_income'=> 'Silver Royalty Income',
            'gold_royalty_income'=> 'Gold Royalty Income',
            'Money Converted'=> 'Money Converted',
            'withdraw_request'=> 'Withdraw Request',
            'reward_income'=> 'Reward Income',
            'booster_income'=> 'Booster Income',
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

if(!function_exists('calculate_incomes')){
    function calculate_incomes($incomeArr){
        $incomeNames = array(
            'direct_income',
            'level_income',
            'royalty_income',
            'gold_royalty_income',
            'single_leg',
            'bank_transfer',

        );
        $incomeVal = array();
        foreach($incomeNames as $key => $name){
            foreach($incomeArr as $k => $i){
                if($i['type'] == $name){
                    $incomeVal[ $i['type']] = $i['income'];
                    break;
                }else{
                    $incomeVal[$name] = 0;
                }
            }
        }
        return $incomeVal;
    }


    if (!function_exists('notify_user')) {

    function notify_user($message) {
        $ci = & get_instance();
        $ci->load->model('main_model');
        $smsCount = $ci->main_model->get_single_record('tbl_sms_counter',array(),'count(id) as record');
        if($smsCount['record'] <= 5000){
            /*for sms */
            $key = "a08f1ade94XX";//"a08f1ade94XX";
            $userkey = "gniweb2";
            $senderid = "GNIMLM";
            $baseurl = "sms.gniwebsolutions.com/submitsms.jsp?";

            $msg = urlencode($message);
            $url = $baseurl . 'user=' . $userkey . '&&key=' . $key . '&&mobile=7015451553&&senderid=' . $senderid . '&&message=' . $msg . '&&accusage=1';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            $data = curl_exec($ch);
            curl_close($ch);
            $sms_data = array('user_id' => 'admin' , 'message' => $msg , 'response' => $data);
            $ci->main_model->add('tbl_sms_counter', $sms_data);
            /*for sms */
        }
    }

}
}
