<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('Main_model'));
        $this->load->helper(array('admin', 'security'));
        date_default_timezone_set('Asia/Kolkata');
        // if (!$this->input->is_cli_request()) {
        //     show_error('Direct access is not allowed');
        //     exit;
        // }
    }

    public function index() {

    }

    public function autoBlock(){
        $users = $this->Main_model->get_records('tbl_users',['paid_status' => 0],'*');
        foreach($users as $key => $user){
            $date1 = date('Y-m-d H:i:s');
            $date2 = date('Y-m-d H:i:s',strtotime($user['created_at'].'+ 48 hours'));
            $diff = strtotime($date1) - strtotime($date2);
            if($diff > 0){
                $this->Main_model->update('tbl_users',['user_id' => $user['user_id']],['disabled' => 1]);
            }
        }
    }

    public function remove_roi_level(){
        //die('Stop');
        $achievers = $this->Main_model->checkRoiLevel();
        foreach($achievers as $key => $ac){
            for($i=1;$i<=14;$i++){
                $users = $this->Main_model->get_single_record('tbl_roi',array('user_id' => $ac['user_id'],'level' => $i),'*');
                if(!empty($users)){
                    $date1 = date('Y-m-d H:i:s');
                    $date2 = date('Y-m-d H:i:s',strtotime($users['created_at'].'+ 72 hours'));
                    $diff = strtotime($date1) - strtotime($date2);
                    //echo $diff . 'level '.$i.'<br>';
                    if($diff > 0){
                        $this->lapsLevel($users['id'],$ac['user_id'],$i);
                    }
                }else{
                    $i = 14;
                }
            }
        }
    }

    public function lapsLevel($id,$user_id,$level){
        $legArr = array(
            1 => array('winning_team' => 100, 'direct_sponser' => 1, 'amount' =>50, 'days' => 30),
            2 => array('winning_team' => 300, 'direct_sponser' => 2, 'amount' => 50, 'days' => 40),
            3 => array('winning_team' => 700, 'direct_sponser' => 3, 'amount' => 60, 'days' => 55),
            4 => array('winning_team' => 1700, 'direct_sponser' => 4, 'amount' => 80, 'days' => 55),
            5 => array('winning_team' => 3700, 'direct_sponser' => 6, 'amount' => 150, 'days' => 60),
            6 => array('winning_team' => 6700, 'direct_sponser' => 8, 'amount' => 300, 'days' => 60),
            7 => array('winning_team' => 11700, 'direct_sponser' => 11, 'amount' => 400, 'days' => 90),
            8 => array('winning_team' => 21700, 'direct_sponser' => 14, 'amount' => 700, 'days' => 100),
            9 => array('winning_team' => 46700, 'direct_sponser' => 19, 'amount' => 1000, 'days' => 120),
            10 => array('winning_team' => 96700, 'direct_sponser' => 24, 'amount' => 2000, 'days' => 120),
            11 => array('winning_team' => 196700, 'direct_sponser' => 30, 'amount' => 3000, 'days' => 130),
            12 => array('winning_team' => 396700, 'direct_sponser' => 36, 'amount' => 5000, 'days' => 140),
            13 => array('winning_team' => 796700, 'direct_sponser' => 44, 'amount' => 10000, 'days' => 150),
            14 => array('winning_team' => 1396700, 'direct_sponser' => 52, 'amount' => 20000, 'days' => 170),
            15 => array('winning_team' => 2196700, 'direct_sponser' => 60, 'amount' => 30000, 'days' => 200),
        );
        foreach($legArr as $key => $la){
            if($level == $key){
                $userdata = $this->Main_model->get_single_record('tbl_users',array('user_id' => $user_id),'directs');
                if($userdata['directs'] < $la['direct_sponser']){
                    $this->Main_model->update('tbl_roi',array('id' => $id,'level' => $level),array('days' => 0));
                }
            }
        }
    }

    public function calculate_roi_users(){
        echo 'Start: '.date('H:i:s');
        $last_id = $this->Main_model->get_single_record_desc('tbl_users',array(),'id');
        $achievers = $this->Main_model->get_records('tbl_users', array('paid_status' => 1), 'id,user_id,sponser_id,directs,total_user_after_paid,single_leg_status');
        $legArr = array(
            1 => array('winning_team' => 100, 'direct_sponser' => 1, 'amount' =>50, 'days' => 30),
            2 => array('winning_team' => 300, 'direct_sponser' => 2, 'amount' => 50, 'days' => 40),
            3 => array('winning_team' => 700, 'direct_sponser' => 3, 'amount' => 60, 'days' => 55),
            4 => array('winning_team' => 1700, 'direct_sponser' => 4, 'amount' => 80, 'days' => 55),
            5 => array('winning_team' => 3700, 'direct_sponser' => 6, 'amount' => 150, 'days' => 60),
            6 => array('winning_team' => 6700, 'direct_sponser' => 8, 'amount' => 300, 'days' => 60),
            7 => array('winning_team' => 11700, 'direct_sponser' => 11, 'amount' => 400, 'days' => 90),
            8 => array('winning_team' => 21700, 'direct_sponser' => 14, 'amount' => 700, 'days' => 100),
            9 => array('winning_team' => 46700, 'direct_sponser' => 19, 'amount' => 1000, 'days' => 120),
            10 => array('winning_team' => 96700, 'direct_sponser' => 24, 'amount' => 2000, 'days' => 120),
            11 => array('winning_team' => 196700, 'direct_sponser' => 30, 'amount' => 3000, 'days' => 130),
            12 => array('winning_team' => 396700, 'direct_sponser' => 36, 'amount' => 5000, 'days' => 140),
            13 => array('winning_team' => 796700, 'direct_sponser' => 44, 'amount' => 10000, 'days' => 150),
            14 => array('winning_team' => 1396700, 'direct_sponser' => 52, 'amount' => 20000, 'days' => 170),
            15 => array('winning_team' => 2196700, 'direct_sponser' => 60, 'amount' => 30000, 'days' => 200),
        );
        foreach($achievers as $key => $achiever){
            $directs = $this->Main_model->get_single_record('tbl_users', array('sponser_id' => $achiever['user_id'] , 'paid_status' => 1), 'ifnull(count(id),0) as directs');
            foreach($legArr as $key2 => $la){
                if($achiever['single_leg_status'] < $key2){
                    $new_id = $last_id['id'] - $achiever['id'];
                    if($directs['directs'] >= $la['direct_sponser'] && ($achiever['total_user_after_paid']) >= $la['winning_team']){
                        $roi_user = $this->Main_model->get_single_record('tbl_roi', array('user_id' => $achiever['user_id'] , 'level' => $key2), '*');
                        if(empty($roi_user)){

                            $roiArr = array(
                                'user_id' => $achiever['user_id'],
                                'amount' => $la['amount'],
                                'type' => 'single_leg',
                                'remark' =>'Single Leg Income for '.$key2.'  Level',
                                'level' => $key2,
                                'days' => $la['days'],
                            );
                            pr($roiArr);
                            echo date('H:i:s');
                            $this->Main_model->add('tbl_roi', $roiArr);
                            $this->Main_model->update('tbl_users', array('user_id' => $achiever['user_id']), array('single_leg_status' => $key2));
                        }
                    }
                }
            }
        }
        echo 'Done'.date('H:i:s');
    }

    public function credit_roi_income(){
        $cron = $this->Main_model->get_single_record('tbl_cron','  date(created_at) = date(now()) and cron_name = "roi_cron"' ,'*');
        if(empty($cron)){
            for ($i=1; $i < 15; $i++) {
                $achievers = $this->Main_model->get_records('tbl_roi', array('days >' => 0, 'level' => $i), '*');
                foreach($achievers as $key => $achiever){
                    $legArr = array(
                        1 => array('winning_team' => 100, 'direct_sponser' => 1, 'amount' =>50, 'days' => 30),
                        2 => array('winning_team' => 300, 'direct_sponser' => 2, 'amount' => 50, 'days' => 40),
                        3 => array('winning_team' => 700, 'direct_sponser' => 3, 'amount' => 60, 'days' => 55),
                        4 => array('winning_team' => 1700, 'direct_sponser' => 4, 'amount' => 80, 'days' => 55),
                        5 => array('winning_team' => 3700, 'direct_sponser' => 6, 'amount' => 150, 'days' => 60),
                        6 => array('winning_team' => 6700, 'direct_sponser' => 8, 'amount' => 300, 'days' => 60),
                        7 => array('winning_team' => 11700, 'direct_sponser' => 11, 'amount' => 400, 'days' => 90),
                        8 => array('winning_team' => 21700, 'direct_sponser' => 14, 'amount' => 700, 'days' => 100),
                        9 => array('winning_team' => 46700, 'direct_sponser' => 19, 'amount' => 1000, 'days' => 120),
                        10 => array('winning_team' => 96700, 'direct_sponser' => 24, 'amount' => 2000, 'days' => 120),
                        11 => array('winning_team' => 196700, 'direct_sponser' => 30, 'amount' => 3000, 'days' => 130),
                        12 => array('winning_team' => 396700, 'direct_sponser' => 36, 'amount' => 5000, 'days' => 140),
                        13 => array('winning_team' => 796700, 'direct_sponser' => 44, 'amount' => 10000, 'days' => 150),
                        14 => array('winning_team' => 1396700, 'direct_sponser' => 52, 'amount' => 20000, 'days' => 170),
                        15 => array('winning_team' => 2196700, 'direct_sponser' => 60, 'amount' => 30000, 'days' => 200),
                    );
                    $user = $this->Main_model->get_single_record('tbl_users', array('user_id' => str_replace(' ','',$achiever['user_id'])), 'id,user_id,directs,single_leg_status,paid_status');

                    if($user['directs'] >= $legArr[$achiever['level']]['direct_sponser'] && $user['paid_status'] == 1){
                        if($achiever['level'] < 6){
                            $income = array(
                                'user_id' => $achiever['user_id'],
                                'amount' => $achiever['amount'],
                                'type' => $achiever['type'],
                                'description' => $achiever['remark'] .' At Day '.$achiever['days'],
                                'level' => $achiever['level'],
                            );

                            $this->Main_model->add('tbl_income_wallet', $income);
                        }elseif($achiever['level'] > 5){
                            if($achiever['days'] == $legArr[$achiever['level']]['days']){
                                $income = array(
                                    'user_id' => $achiever['user_id'],
                                    'amount' => $achiever['amount'],
                                    'type' => 'repurchase_income',
                                    'description' => 'Repurchase Income At Day '.$achiever['days'].' at level '.$achiever['level'],
                                    'level' => $achiever['level'],
                                );

                                $this->Main_model->add('tbl_income_wallet', $income);
                            }else{
                                $income = array(
                                    'user_id' => $achiever['user_id'],
                                    'amount' => $achiever['amount'],
                                    'type' => $achiever['type'],
                                    'description' => $achiever['remark'] .' At Day '.$achiever['days'],
                                    'level' => $achiever['level'],
                                );

                                $this->Main_model->add('tbl_income_wallet', $income);
                            }
                        }
                        

                        pr($user);
                        $this->Main_model->update('tbl_roi', array('id' => $achiever['id']), array('days' => $achiever['days'] - 1));
                    }
                }
            }
            $this->Main_model->add('tbl_cron', array('cron_name' => 'roi_cron'));
            echo 'Done';
        }else{
            echo'today cron already run';
        }
    }

    public function credit_repurchase(){
        $incomes = $this->Main_model->get_records('tbl_income_wallet',['type' => 'repurchase_income'],'*');
        foreach($incomes as $key => $income){
            $income = array(
                'user_id' => $income['user_id'],
                'amount' => abs($income['amount']),
                'type' => 'single_leg',
                'description' => $income['description'],
            );

            $this->Main_model->add('tbl_income_wallet', $income);
        }
    }
    public function royalty_income(){
        die('send manually');
        $cron = $this->Main_model->get_single_record('tbl_cron',' date(created_at) = date(now()) and cron_name = "reward_cron"' ,'*');
        if(empty($cron)){
            $achievers = $this->Main_model->get_records('tbl_users', array('directs >=' => 25), 'id,user_id,name,phone');//$this->Main_model->rewards_users();
            $today_ids = $this->Main_model->get_single_record('tbl_users', 'date(topup_date) = date(now()) - 1', 'ifnull(count(id),0) as today_ids');
            echo ' Today Joings '.$today_ids['today_ids'].'<br>';
            $distributable_income = $today_ids['today_ids'] * 15;
            echo 'Today Rewards Income '.$distributable_income.'<br>';
            $per_pair_amount = $distributable_income / count($achievers);
            echo'per pair amount : ' .$per_pair_amount.'<br>';
            foreach($achievers as $key => $achiever){
                $income = array(
                    'user_id' => $achiever['user_id'],
                    'amount' => $per_pair_amount,
                    'type' => 'royalty_income',
                    'description' => 'Daily Silver Royalty Income',
                );
                    pr($income);
                $this->Main_model->add('tbl_income_wallet', $income);
            }
            $this->Main_model->add('tbl_cron', array('cron_name' => 'reward_cron'));
        }else{
            echo'today cron already run';
        }
    }

    public function gold_royalty_income(){
        die('send manually');
        $cron = $this->Main_model->get_single_record('tbl_cron',' date(created_at) = date(now()) and cron_name = "gold_royalty"' ,'*');
        if(empty($cron)){
            $achievers = $this->Main_model->get_records('tbl_users', array('directs >=' => 50), 'id,user_id,name,phone');//$this->Main_model->rewards_users();
            $today_ids = $this->Main_model->get_single_record('tbl_users', 'date(topup_date) = date(now()) - 1', 'ifnull(count(id),0) as today_ids');
            echo ' Today Joings '.$today_ids['today_ids'].'<br>';
            $distributable_income = $today_ids['today_ids'] * 25;
            echo 'Today Rewards Income '.$distributable_income.'<br>';
            $per_pair_amount = $distributable_income / count($achievers);
            echo'per pair amount : ' .$per_pair_amount.'<br>';
            foreach($achievers as $key => $achiever){
                $income = array(
                    'user_id' => $achiever['user_id'],
                    'amount' => $per_pair_amount,
                    'type' => 'gold_royalty_income',
                    'description' => 'Daily Gold Royalty Income',
                );
                    pr($income);
                $this->Main_model->add('tbl_income_wallet', $income);
            }
            $this->Main_model->add('tbl_cron', array('cron_name' => 'gold_royalty'));
        }else{
            echo'today cron already run';
        }
    }

    public function leadership_income(){
        die('send manually');
        $cron = $this->Main_model->get_single_record('tbl_cron',' date(created_at) = date(now()) and cron_name = "leadership_income"' ,'*');
        if(empty($cron)){
            $today_ids = $this->Main_model->get_single_record('tbl_users', 'date(topup_date) = date(now()) - 1', 'ifnull(count(id),0) as today_ids');
            echo ' Today Joings '.$today_ids['today_ids'].'<br>';
            $distributable_income = $today_ids['today_ids'] * 10;
            echo 'Today Rewards Income '.$distributable_income.'<br>';

            $royalty_achievers = $this->Main_model->get_records('tbl_users',['single_leg_status >=' => '1','directs >=' => '5'],'user_id');
            $i = 0;
            foreach($royalty_achievers as $key => $achiever){
                $a = $this->Main_model->get_single_record('tbl_users',array('sponser_id' => $achiever['user_id'],'directs >=' => '5') , 'count(id) as record');
                if($a['record'] >= 5){
                    $achievers[$i] = $achiever;
                    $i++;
                }
            }

            $per_pair_amount = $distributable_income / count($achievers);
            echo'per pair amount : ' .$per_pair_amount.'<br>';
            foreach($achievers as $key => $achiever){
                $income = array(
                    'user_id' => $achiever['user_id'],
                    'amount' => $per_pair_amount,
                    'type' => 'leadership_income',
                    'description' => 'LeaderShip Bonus',
                );
                    pr($income);
                $this->Main_model->add('tbl_income_wallet', $income);
            }
            $this->Main_model->add('tbl_cron', array('cron_name' => 'leadership_income'));
        }else{
            echo'today cron already run';
        }
    }

    public function calculate_reward_users(){
        $users = $this->Main_model->get_records('tbl_users', 'date(topup_date) = date(now()) - 1 and paid_status = 1', 'id,user_id,directs,topup_date');
        foreach($users as $key => $user){
            pr($user);
            if($user['directs'] >= 125){
                $roiArr = array(
                    'user_id' => $user['user_id'],
                    'amount' => 50,
                    'type' => 'booster_income',
                    'remark' =>'Leadership Income for Team Directs',
                    'level' => 0,
                    'days' => 100,
                );
                $this->Main_model->add('tbl_roi', $roiArr);
            }
            if($user['directs'] >= 150){
                $roiArr = array(
                    'user_id' => $user['user_id'],
                    'amount' => 50,
                    'type' => 'booster_income',
                    'remark' =>'Leadership Income for Team Directs',
                    'level' => 0,
                    'days' => 100,
                );
                $this->Main_model->add('tbl_roi', $roiArr);
            }
            if($user['directs'] >= 1000){
                $roiArr = array(
                    'user_id' => $user['user_id'],
                    'amount' => 50,
                    'type' => 'booster_income',
                    'remark' =>'Leadership Income for Team Directs',
                    'level' => 0,
                    'days' => 100,
                );
                $this->Main_model->add('tbl_roi', $roiArr);
            }
        }
    }

    public function retopup_cron(){
        $retopup_users = $this->Main_model->retopup_users();
        // pr($retopup_users);
        foreach($retopup_users as $key => $user){
            pr($user);
            if($user['income'] > (5000 * $user['retopup_count'])){
                echo'make free this user';
                $this->Main_model->update('tbl_users', array('user_id' => $user['user_id']), array('paid_status' => 0));
            }
        }
    }
    // public function update_directs_count(){
    //     $paid_users = $this->Main_model->get_records('tbl_users', array('paid_status' => 1), 'id,user_id,sponser_id');
    //     foreach($paid_users as $key => $user){
    //         $this->Main_model->update_directs($user['sponser_id']);
    //     }
    // }
    public function pool_income_cron(){
      echo "its holdidays yeah";
      die;
        $achievers = $this->Main_model->get_records('tbl_pool', array('level7' => 128 ,'income_status' => 0), 'id,user_id');//$this->Main_model->rewards_users();
        foreach($achievers as $key => $achiever){
            $income = array(
                'user_id' => $achiever['user_id'],
                'amount' => 7100,
                'type' => 'pool_income',
                'description' => 'Pool Income',
            );
                pr($income);
            $this->Main_model->add('tbl_income_wallet', $income);
            $this->Main_model->update('tbl_pool', array('user_id' => $achiever['user_id']), array('income_status' => 1));
        }
    }
    public function delete_mulitple_roi(){
        $rois = $this->Main_model->get_records('tbl_roi',[],'*');
        foreach($rois as $key => $roi){
            $repeatroi = $this->Main_model->get_records('tbl_roi',['user_id' => $roi['user_id'],'level' => $roi['level'] ,'id !=' => $roi['id']],'*');
            if(!empty($repeatroi)){
                pr($repeatroi);
                $this->Main_model->delete_roi('tbl_roi',['user_id' => $roi['user_id'],'level' => $roi['level'] ,'id !=' => $roi['id']]);
            }
        }
    }







    ////// test functions 


    // public function test_credit_roi_income(){
    // //   echo "its holdidays yeah";
    // //   die;
    // //   if(date('D') == 'Sat'){
    // //       die('its weekend');
    // //   }
    //     // $cron = $this->Main_model->get_single_record('tbl_cron','  date(created_at) = date(now()) and cron_name = "roi_cron"' ,'*');
    //     // if(empty($cron)){
    //     echo date('H:i:s');
    //     // for ($i=1; $i < 15; $i++) {
    //     //     echo 'Level: '.$i.' '.date('H:i:s');
    //         $achievers = $this->Main_model->get_records('tbl_roi', array('days >' => 0), '*');
    //         foreach($achievers as $key => $achiever){
    //             // pr();
    //             // pr($key+1);
    //             // pr($achiever['user_id']);
    //             //$data[] = $achiever;
    //             $legArr = array(
    //                 1 => array('winning_team' => 100, 'direct_sponser' => 1, 'amount' => 50, 'days' => 30),
    //                 2 => array('winning_team' => 300, 'direct_sponser' => 2, 'amount' => 50, 'days' => 40),
    //                 3 => array('winning_team' => 700, 'direct_sponser' => 3, 'amount' => 60, 'days' => 50),
    //                 4 => array('winning_team' => 1700, 'direct_sponser' => 4, 'amount' => 80, 'days' => 55),
    //                 5 => array('winning_team' => 3700, 'direct_sponser' => 5, 'amount' => 150, 'days' => 60),
    //                 6 => array('winning_team' => 8700, 'direct_sponser' => 7, 'amount' => 300, 'days' => 70),
    //                 7 => array('winning_team' => 18700, 'direct_sponser' => 9, 'amount' => 400, 'days' => 90),
    //                 8 => array('winning_team' => 38700, 'direct_sponser' =>12, 'amount' => 700, 'days' => 100),
    //                 9 => array('winning_team' => 88700, 'direct_sponser' => 17, 'amount' => 1000, 'days' => 120),
    //                 10 => array('winning_team' => 188700, 'direct_sponser' => 22, 'amount' => 2000, 'days' => 120),
    //                 11 => array('winning_team' => 388700, 'direct_sponser' => 28, 'amount' => 3000, 'days' => 130),
    //                 12 => array('winning_team' => 688700, 'direct_sponser' => 34, 'amount' => 5000, 'days' => 140),
    //                 13 => array('winning_team' => 1288700, 'direct_sponser' => 42, 'amount' => 10000, 'days' => 170),
    //                 14 => array('winning_team' => 2288700, 'direct_sponser' => 50, 'amount' => 20000, 'days' => 200),
    //             );
    //             $user = $this->Main_model->get_single_record('tbl_users', array('user_id' => str_replace(' ','',$achiever['user_id'])), 'id,user_id,directs,single_leg_status,paid_status');

    //             if($user['directs'] >= $legArr[$achiever['level']]['direct_sponser'] && $user['paid_status'] == 1){
    //                 if($achiever['level'] < 6){
    //                     $income = array(
    //                         'user_id' => $achiever['user_id'],
    //                         'amount' => $achiever['amount'],
    //                         'type' => $achiever['type'],
    //                         'description' => $achiever['remark'] .' At Day '.$achiever['days'],
    //                         // 'level' => $achiever['level'],
    //                     );
    //                     pr($income);

    //                     //$this->Main_model->add('tbl_income_wallet', $income);
    //                 }elseif($achiever['level'] > 5){
    //                     if($achiever['days'] == $legArr[$achiever['level']]['days']){
    //                         $income = array(
    //                             'user_id' => $achiever['user_id'],
    //                             'amount' => $achiever['amount'],
    //                             'type' => 'repurchase_income',
    //                             'description' => 'Repurchase Income At Day '.$achiever['days'].' at level '.$achiever['level'],
    //                             // 'level' => $achiever['level'],
    //                         );

    //                         pr($income);

    //                         //$this->Main_model->add('tbl_income_wallet', $income);
    //                     }else{
    //                         $income = array(
    //                             'user_id' => $achiever['user_id'],
    //                             'amount' => $achiever['amount'],
    //                             'type' => $achiever['type'],
    //                             'description' => $achiever['remark'] .' At Day '.$achiever['days'],
    //                             // 'level' => $achiever['level'],
    //                         );

    //                         pr($income);

    //                         //$this->Main_model->add('tbl_income_wallet', $income);
    //                     }
    //                 }
                    


    //                 //pr($user);
    //                  ///$this->Main_model->update('tbl_roi', array('id' => $achiever['id']), array('days' => $achiever['days'] - 1));
    //             }
    //             echo date('H:i:s');
    //         // }
    //     }

    //     //echo '<br>'.count($data);
    //     //     $this->Main_model->add('tbl_cron', array('cron_name' => 'roi_cron'));

    //     // }else{
    //     //     echo'today cron already run';
    //     // }
    // }



    // public function testLevelUpdate(){
    //     $achievers = $this->Main_model->get_records('tbl_roi', 'days > 0 AND date(created_at) = "2020-09-02"', '*');
    //     foreach($achievers as $key => $achiever){
    //             $legArr = array(
    //                 1 => array('winning_team' => 100, 'direct_sponser' => 1, 'amount' => 50, 'days' => 30),
    //                 2 => array('winning_team' => 300, 'direct_sponser' => 2, 'amount' => 50, 'days' => 40),
    //                 3 => array('winning_team' => 700, 'direct_sponser' => 3, 'amount' => 60, 'days' => 50),
    //                 4 => array('winning_team' => 1700, 'direct_sponser' => 4, 'amount' => 80, 'days' => 55),
    //                 5 => array('winning_team' => 3700, 'direct_sponser' => 5, 'amount' => 150, 'days' => 60),
    //                 6 => array('winning_team' => 8700, 'direct_sponser' => 7, 'amount' => 300, 'days' => 70),
    //                 7 => array('winning_team' => 18700, 'direct_sponser' => 9, 'amount' => 400, 'days' => 90),
    //                 8 => array('winning_team' => 38700, 'direct_sponser' =>12, 'amount' => 700, 'days' => 100),
    //                 9 => array('winning_team' => 88700, 'direct_sponser' => 17, 'amount' => 1000, 'days' => 120),
    //                 10 => array('winning_team' => 188700, 'direct_sponser' => 22, 'amount' => 2000, 'days' => 120),
    //                 11 => array('winning_team' => 388700, 'direct_sponser' => 28, 'amount' => 3000, 'days' => 130),
    //                 12 => array('winning_team' => 688700, 'direct_sponser' => 34, 'amount' => 5000, 'days' => 140),
    //                 13 => array('winning_team' => 1288700, 'direct_sponser' => 42, 'amount' => 10000, 'days' => 170),
    //                 14 => array('winning_team' => 2288700, 'direct_sponser' => 50, 'amount' => 20000, 'days' => 200),
    //             );
    //             $user = $this->Main_model->get_single_record('tbl_users', array('user_id' => str_replace(' ','',$achiever['user_id'])), 'id,user_id,directs,single_leg_status,paid_status');

    //             $get = $this->Main_model->get_single_record('tbl_income_wallet', 'user_id = "'.$achiever['user_id'].'" AND level = "'.$achiever['level'].'" AND date(created_at) = "2020-09-03"', 'user_id,level');
    //             if(empty($get['user_id'])){
    //                 $data[] = $get['user_id'];
    //                 if($user['directs'] >= $legArr[$achiever['level']]['direct_sponser'] && $user['paid_status'] == 1){
    //                     if($achiever['level'] < 6){
    //                         $income = array(
    //                             'user_id' => $achiever['user_id'],
    //                             'amount' => $achiever['amount'],
    //                             'type' => $achiever['type'],
    //                             'description' => $achiever['remark'] .' At Day '.$achiever['days'],
    //                             'level' => $achiever['level'],
    //                         );
    //                         pr($income);
    //                         $this->Main_model->add('tbl_income_wallet', $income);
    //                     }elseif($achiever['level'] > 5){
    //                         if($achiever['days'] == $legArr[$achiever['level']]['days']){
    //                             $income = array(
    //                                 'user_id' => $achiever['user_id'],
    //                                 'amount' => $achiever['amount'],
    //                                 'type' => 'repurchase_income',
    //                                 'description' => 'Repurchase Income At Day '.$achiever['days'].' at level '.$achiever['level'],
    //                                 'level' => $achiever['level'],
    //                             );
    //                             pr($income);
    //                             $this->Main_model->add('tbl_income_wallet', $income);
    //                         }else{
    //                             $income = array(
    //                                 'user_id' => $achiever['user_id'],
    //                                 'amount' => $achiever['amount'],
    //                                 'type' => $achiever['type'],
    //                                 'description' => $achiever['remark'] .' At Day '.$achiever['days'],
    //                                 'level' => $achiever['level'],
    //                             );
    //                             pr($income);
    //                             $this->Main_model->add('tbl_income_wallet', $income);
    //                         }
    //                     }
                        

    //                     //pr($user);
    //                     $this->Main_model->update('tbl_roi', array('id' => $achiever['id']), array('days' => $achiever['days'] - 1));
    //                 }
    //             }
    //         }
        
    //     echo count($data);
    //     // foreach ($user as $key => $value) {
    //     //    $get = $this->Main_model->get_single_record('tbl_income_wallet', 'user_id = "'.$value['user_id'].'" AND level = "'.$value['level'].'" AND date(created_at) = "2020-09-03"', 'user_id,level');
    //     //   // pr($get);
           
    //     //     if(empty($get['user_id'])){
    //     //         // if($value['level'] != $)
    //     //         $data[] = $get['user_id'];
    //     //      pr($value);
    //     //     }
           
    //     //     # code...
    //     // }
    //     // echo count();
    //     // echo 'done';
    //     // //echo substr($user['description'],8);
    // }
}
