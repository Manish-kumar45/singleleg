<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('User_model'));
        $this->load->helper(array('user', 'birthdate', 'security', 'email'));
    }

    public function index() {
        if (is_logged_in()) {
            redirect('Dashboard/User/');
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function coupans() {
        if (is_logged_in()) {
            $response = array();
            $this->load->view('coupons-amazing', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    // public function ActivateAccount() {
    //     if (is_logged_in()) {
    //         $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
    //         if ($this->input->server('REQUEST_METHOD') == 'POST') {
    //             $data = $this->security->xss_clean($this->input->post());
    //             $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|xss_clean');
    //             $this->form_validation->set_rules('master_key', 'Txn. Password', 'trim|required|xss_clean');
    //             if ($this->form_validation->run() != FALSE) {
    //                 $user_id = $data['user_id'];
    //                 $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
    //                 $wallet = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
    //                 $package = $this->User_model->get_single_record('tbl_package', array('id' => $data['package_id']), '*');
    //                 if ($response['user']['master_key'] == $data['master_key']) {
    //                     if (!empty($user)) {
    //                         if ($wallet['wallet_balance'] >= $package['price']) {
    //                             if ($user['paid_status'] == 0) {
    //                                 $sendWallet = array(
    //                                     'user_id' => $this->session->userdata['user_id'],
    //                                     'amount' => -$package['price'],
    //                                     'type' => 'account_activation',
    //                                     'remark' => 'Account Activation Deduction for ' . $user_id,
    //                                 );
    //                                 $this->User_model->add('tbl_wallet', $sendWallet);
    //                                 $topupData = array(
    //                                     'paid_status' => 1,
    //                                     'package_id' => $data['package_id'],
    //                                     'package_amount' => $package['price'],
    //                                     'topup_date' => date('Y-m-d h:i:s'),
    //                                     'retopup_count' => $user['retopup_count'] + 1,
    //                                 );
    //                                 $this->User_model->update('tbl_users', array('user_id' => $user_id), $topupData);
    //                                 $this->User_model->update_directs($user['sponser_id']);
    //                                 $this->User_model->total_team_update($user['id']);
    //                                 $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), 'sponser_id,directs,paid_status');
    //                                 if($sponser['paid_status'] == 1){
    //                                     $DirectIncome = array(
    //                                         'user_id' => $user['sponser_id'],
    //                                         'amount' => $package['direct_income'],
    //                                         'type' => 'direct_income',
    //                                         'description' => 'Direct Income from Activation of Member ' . $user_id,
    //                                     );
    //                                     $this->User_model->add('tbl_income_wallet', $DirectIncome);
    //                                 }
    //                                 $this->level_income($sponser['sponser_id'], $user['user_id'], $package['level_income']);
    //                                 $this->add_team_counts($user['user_id'], $user['user_id']);
    //                                 $this->session->set_flashdata('message', 'Account Activated Successfully');
    //                             } else {
    //                                 $this->session->set_flashdata('message', 'This Account Already Acitvated');
    //                             }
    //                         } else {
    //                             $this->session->set_flashdata('message', 'Insuffcient Balance');
    //                         }
    //                     } else {
    //                         $this->session->set_flashdata('message', 'Invalid User ID');
    //                     }
    //                 } else {
    //                     $this->session->set_flashdata('message', 'Incorrect Txn Password');
    //                 }
    //             }
    //         }
    //         $response['wallet'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
    //         $response['packages'] = $this->User_model->get_records('tbl_package', array(), '*');
    //         $this->load->view('activate_account', $response);
    //     } else {
    //         redirect('Dashboard/User/login');
    //     }
    // }


    public function ActivateAccount($epin = '') {
        if (is_logged_in()) {
            //redirect('Dashboard/User');
            //die;
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                // $this->session->set_flashdata('message', 'Please Wait!');

                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $user_id = $data['user_id'];
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                    $pin_status = $this->User_model->get_single_record('tbl_epins', array('user_id' => $this->session->userdata['user_id'], 'epin' => $data['epin']), '*');
                    if (!empty($pin_status)) {
                        $package = $this->User_model->get_single_record('tbl_package', array('id' => $data['package_id']), '*');
                        if (!empty($user)) {
                            if ($pin_status['status'] == 0) {
                                if ($user['paid_status'] == 0) {
                                    $topupData = array(
                                        'paid_status' => 1,
                                        'package_id' => $data['package_id'],
                                        'package_amount' => $package['price'],
                                        'topup_date' => date('Y-m-d H:i:s'),
                                        // 'capping' => $package['capping'],
                                    );
                                    $this->User_model->update('tbl_users', array('user_id' => $user_id), $topupData);
                                    $this->User_model->update('tbl_epins', array('id' => $pin_status['id']), array('used_for' => $user['user_id'], 'status' => 1));
                                    $this->User_model->update_directs($user['sponser_id']);
                                    $this->User_model->total_team_update($user['id']);
                                    // $this->calculate_waste_points();
                                    $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), 'sponser_id,directs,paid_status');
                                    if($sponser['paid_status'] == 1){
                                        $DirectIncome = array(
                                            'user_id' => $user['sponser_id'],
                                            'amount' => $package['direct_income'],
                                            'type' => 'direct_income',
                                            'description' => 'Direct Income from Activation of Member ' . $user_id,
                                        );
                                        $this->User_model->add('tbl_income_wallet', $DirectIncome);
                                    }
                                    $this->level_income($sponser['sponser_id'], $user['user_id'], $package['level_income']);
                                    $this->add_team_counts($user['user_id'], $user['user_id']);
                                    $this->royaltyAchiever($user['sponser_id']);
                                    //$this->update_business($user['user_id'], $user['user_id'], $level = 1, $package['bv'] , $type = 'topup');
                                    // $sms_text = 'Dear User Login ID : '.$user['user_id'] .' Account Has been Successfully Activated Please Wait for your PH links '.base_url();
                                    // notify_user($user['user_id'], $sms_text);
                                    redirect('Dashboard/Settings/epins/0');
                                    $this->session->set_flashdata('message', 'Account Activated Successfully');
                                } else {
                                    $this->session->set_flashdata('message', 'This Account Already Acitvated');
                                }
                            } else {
                                $this->session->set_flashdata('message', 'Expired Epin');
                            }
                        } else {
                            $this->session->set_flashdata('message', 'Invalid User ID');
                        }
                    } else {
                        $this->session->set_flashdata('message', 'This Pin is not valid for you');
                    }
                }
            }
            $response['available_pins'] = $this->User_model->get_single_record('tbl_epins', array('user_id' => $this->session->userdata['user_id'], 'status' => 0), 'ifnull(count(id),0) as available_pins');
            $response['packages'] = $this->User_model->get_records('tbl_package', array(), '*');
            $response['epin'] = $epin;
            $this->load->view('activate_account', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    private function royaltyAchiever($user_id){
        $user = $this->User_model->get_single_record('tbl_users',['user_id' => $user_id],'directs,topup_date');
        $date1 = date('Y-m-d H:i:s');
        $date2 = date('Y-m-d H:i:s',strtotime($user['topup_date'].'+ 15 days'));
        $diff = strtotime($date2) - strtotime($date1);
        if($diff > 0){
            if($user['directs'] >= 40){
                $this->User_model->update('tbl_users',['user_id' => $user_id],['royalty_status' => 1]);
            }
        }
    }

    public function calculate_waste_points(){
        $legArr = array(
            1 => array('winning_team' => 65, 'direct_sponser' => 0, 'amount' => 30, 'days' => 50),
            2 => array('winning_team' => 265, 'direct_sponser' => 1, 'amount' => 40, 'days' => 50),
            3 => array('winning_team' => 500, 'direct_sponser' => 2, 'amount' => 50, 'days' => 50),
            4 => array('winning_team' => 1000, 'direct_sponser' => 3, 'amount' => 100, 'days' => 50),
            5 => array('winning_team' => 2000, 'direct_sponser' => 4, 'amount' => 150, 'days' => 50),
            6 => array('winning_team' => 5000, 'direct_sponser' => 5, 'amount' => 250, 'days' => 60),
            7 => array('winning_team' => 10000, 'direct_sponser' => 7, 'amount' => 400, 'days' => 60),
            8 => array('winning_team' => 20000, 'direct_sponser' =>9, 'amount' => 700, 'days' => 60),
            9 => array('winning_team' => 50000, 'direct_sponser' => 12, 'amount' => 1000, 'days' => 60),
            10 => array('winning_team' => 100000, 'direct_sponser' => 17, 'amount' => 1500, 'days' => 60),
            11 => array('winning_team' => 200000, 'direct_sponser' => 22, 'amount' => 2000, 'days' => 90),
            12 => array('winning_team' => 300000, 'direct_sponser' => 30, 'amount' => 2500, 'days' => 90),
            13 => array('winning_team' => 500000, 'direct_sponser' => 38, 'amount' => 3000, 'days' => 90),
            14 => array('winning_team' => 1000000, 'direct_sponser' => 54, 'amount' => 5000, 'days' => 90),
          );
        //   $this->User_model->update_paid_team(['total_user_after_paid <' => 65 , 'paid_status' => 1]);
          foreach($legArr as $k => $la){

            //   $this->User_model->update_paid_team(['total_user_after_paid >' => $la['winning_team'] ,'directs >' => $la['direct_sponser']]);
              $this->User_model->waster_count(['total_user_after_paid >' => $la['winning_team'] ,'directs <=' => $la['direct_sponser']]);
          }
    }
    public function maunal_topup_users(){
        $paid_users = $this->User_model->paid_members('tbl_users', array('paid_status' => 1), 'id,user_id,paid_status,topup_date');
        foreach($paid_users as $key => $user){
            $this->User_model->update_count(['paid_status' => 1 , 'topup_date <' => $user['topup_date']],'after_paid_users');
            pr($user);
        }
    }
    public function PoolUpgrade() {
        if (is_logged_in()) {
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|xss_clean');
                $this->form_validation->set_rules('master_key', 'Txn. Password', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $user_id = $data['user_id'];
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                    $wallet = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
                    // $package = $this->User_model->get_single_record('tbl_package', array('id' => $data['package_id']), '*');
                    $pool = $this->User_model->get_single_record('tbl_pool', array('user_id' => $user_id), '*');
                    $pool_amount = 600;
                    if ($response['user']['master_key'] == $data['master_key']) {
                        if (!empty($user)) {
                            if ($wallet['wallet_balance'] >= $pool_amount) {
                                if ($user['single_leg_status'] >= 5) {
                                    if(empty($pool)){
                                        $sendWallet = array(
                                            'user_id' => $this->session->userdata['user_id'],
                                            'amount' => - $pool_amount,
                                            'type' => 'account_activation',
                                            'remark' => 'Pool Upgrade Deduction for ' . $user_id,
                                        );
                                        $this->User_model->add('tbl_wallet', $sendWallet);
                                        $this->pool_entry($user['user_id']);
                                        $this->session->set_flashdata('message', 'Pool Entry successfull');
                                    }else{
                                        $this->session->set_flashdata('message', 'This Account Already In Pool');
                                    }
                                } else {
                                    $this->session->set_flashdata('message', 'This Account Not Reached At Fifth Level');
                                }
                            } else {
                                $this->session->set_flashdata('message', 'Insuffcient Balance');
                            }
                        } else {
                            $this->session->set_flashdata('message', 'Invalid User ID');
                        }
                    } else {
                        $this->session->set_flashdata('message', 'Incorrect Txn Password');
                    }
                }
            }
            $response['wallet'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
            $response['packages'] = $this->User_model->get_records('tbl_package', array(), '*');
            $this->load->view('pool_upgrade', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function pool_entry($user_id ,$pool_level = 1 , $pool_amount = 500){
        $pool_upline = $this->User_model->get_single_record('tbl_pool', array('level1 <' => 2), 'id,user_id,level1');
        if(!empty($pool_upline)){
            $poolArr =  array(
                'user_id' => $user_id,
                'upline_id' => $pool_upline['user_id'],
            );
            $this->User_model->add('tbl_pool', $poolArr);
            // $this->User_model->update('tbl_pool', array('id' => $pool_upline['id']),array('level1' => $pool_upline['level1'] + 1));
            $this->update_pool_counts($pool_upline['user_id'], (1));
        }else{
            $poolArr =  array(
                'user_id' => $user_id,
                'upline_id' => 'none',
            );
            $this->User_model->add('tbl_pool', $poolArr);
        }
    }
    public function update_pool_counts($pool_id , $level){
        if($level < 8){
            $pool = $this->User_model->get_single_record('tbl_pool', array('user_id' => $pool_id), 'id,user_id,upline_id,level1,level2,level3,level4,level5,level6,level7');
            if(!empty($pool)){
                $this->User_model->update('tbl_pool', array('id' => $pool['id']),array('level'.$level => $pool['level'.$level] + 1));
                $this->update_pool_counts($pool['upline_id'] , ($level+1));
            }

        }
    }
    public function update_team_count() {
        $paid_users = $this->User_model->get_records('tbl_users', array('paid_status' => 1), 'user_id,sponser_id');
        foreach ($paid_users as $key => $user) {
            //pr($user);
            $this->add_team_counts($user['user_id'], $user['user_id']);
        }
    }

    function add_team_counts($user_name = 'DW56497', $downline_id = 'DW56497') {
        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_name), $select = 'sponser_id,user_id');
        if ($user['sponser_id'] != '') {
            $this->User_model->update_team_count('paid_team_count', $user['sponser_id']);
            $user_name = $user['sponser_id'];
            $this->add_team_counts($user_name, $downline_id);
        }
    }

    public function getUserIdForRegister($country_code = '') {
        $sponser = $this->User_model->get_single_record('tbl_users', array(), 'ifnull(max(id_number),0) + 1 as next_id');
        if ($sponser['next_id'] == 1) {
            $user_id = '10001';
        } else {
            $user_id = $sponser['next_id'];
        }
        return $user_id;
    }

    public function DirectIncomeWithdraw() {
        if (is_logged_in()) {
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('master_key', 'Master Key', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    // $user_id = $data['user_id'];
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
                    $kyc_status = $this->User_model->get_single_record('tbl_bank_details', array('user_id' => $this->session->userdata['user_id']), '*');
                    $withdraw_amount = $this->input->post('amount');
                    // $winto_user_id = $this->input->post('user_id');
                    $master_key = $this->input->post('master_key');
                    $balance = $this->User_model->get_single_record('tbl_income_wallet', ' user_id = "' . $this->session->userdata['user_id'] . '"', 'ifnull(sum(amount),0) as balance');
                    if ($withdraw_amount >= 200) {
                        if ($withdraw_amount % 200 == 0) {
                            if ($balance['balance'] >= $withdraw_amount) {
                                if ($user['master_key'] == $master_key) {
                                    // if ($kyc_status['bank_account_number'] != '') {
                                        $DirectIncome = array(
                                            'user_id' => $this->session->userdata['user_id'],
                                            'amount' => - $withdraw_amount,
                                            'type' => 'withdraw_request',
                                            'description' => 'Direct income Withdraw ',
                                        );
                                        $this->User_model->add('tbl_income_wallet', $DirectIncome);
                                        if ($data['pin_transfer'] == 0) {
                                            $withdrawArr = array(
                                                'user_id' => $this->session->userdata['user_id'],
                                                'amount' => $withdraw_amount,
                                                'type' => 'direct_income',
                                                'tds' => $withdraw_amount * 5 / 100,
                                                'admin_charges' => $withdraw_amount * 5 / 100,
                                                'fund_conversion' => 0,
                                                'payable_amount' => $withdraw_amount - ($withdraw_amount * 10 / 100)
                                            );
                                            $this->User_model->add('tbl_withdraw', $withdrawArr);
                                        } else {
                                            $walletArr = array(
                                                'user_id' => $this->session->userdata['user_id'],
                                                'amount' => $withdraw_amount * 90 / 100,
                                                'type' => 'withdraw_request ',
                                                'remark' => 'fund generated from direct income withdraw',
                                                'sender_id' => $this->session->userdata['user_id'],
                                            );
                                            $this->User_model->add('tbl_wallet', $walletArr);
                                        }
                                        $this->session->set_flashdata('message', 'Withdraw Requested     Successfully');
                                    // } else {
                                    //     $this->session->set_flashdata('message', 'Please Complete Fill you Bank Account Details');
                                    // }
                                } else {
                                    $this->session->set_flashdata('message', 'Invalid Master Key');
                                }
                            } else {
                                $this->session->set_flashdata('message', 'Insuffcient Balance');
                            }
                        } else {
                            $this->session->set_flashdata('message', 'Withdraw Amount is multiple of 200');
                        }
                    } else {
                        $this->session->set_flashdata('message', 'Minimum Withdrawal Amount is Rs 200');
                    }
                } else {
                    $this->session->set_flashdata('message', 'erorrrrr');
                }
            }
            $response['balance'] = $this->User_model->get_single_record('tbl_income_wallet', ' user_id = "' . $this->session->userdata['user_id'] . '"', 'ifnull(sum(amount),0) as balance');
            $this->load->view('direct_income_withdraw', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function TransferIncome() {
        if (is_logged_in()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('epins', 'Epins', 'trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('master_key', 'Master Key', 'trim|required|xss_clean');
                $this->form_validation->set_rules('pin_amount', 'Pin Amount', 'trim|required|numeric|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $user = $this->User_model->get_single_record('tbl_income_wallet',['user_id' => $this->session->userdata['user_id']],'ifnull(sum(amount),0) as income,user_id');
                    $master_key = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['user_id']), 'user_id,name,phone,master_key');
                    if ($master_key['master_key'] == $data['master_key']) {
                        $total_pin_amount = $data['pin_amount'] * $data['epins'] * 110 / 100;
                        if ($user['income'] >= $total_pin_amount) {
                            $incomeArr = array(
                                'user_id' => $user['user_id'],
                                'amount' => - $total_pin_amount ,
                                'type' => 'pin_generation', 
                                'description' => 'Amount Used For Pin Generation by '.$master_key['name'],
                            );
                            // income_transaction($incomeArr);
                            $this->User_model->add('tbl_income_wallet', $incomeArr);
                            for ($i = 1; $i <= $data['epins']; $i++) {
                                 $packArr = array(
                                    'user_id' => $user['user_id'],
                                    'epin' => $this->generate_pin(),
                                    'amount' => $data['pin_amount'],
                                    'sender_id' => $this->session->userdata['user_id']
                                );
                                $res = $this->User_model->add('tbl_epins', $packArr);
                                $this->session->set_flashdata('message', 'Pin Generated Successfully');
                            }
                        } else {
                            $this->session->set_flashdata('message', 'Insufficient Balance');
                        }
                    } else {
                        $this->session->set_flashdata('message', 'Invalid Master Key');
                    }
                }
            }
            $response['packages'] = $this->User_model->get_records('tbl_package',[],'id,price');
            $response['user'] = $this->User_model->get_single_record('tbl_income_wallet',['user_id' => $this->session->userdata['user_id']],'ifnull(sum(amount),0) as income,user_id');
            $this->load->view('generate_epin', $response);
        } else {
            redirect('Site/login');
        }
    }
    public function generate_pin() {
        if (is_logged_in()) {
            $epin = md5(rand(100000, 9999999));
            $pin = $this->User_model->get_single_record('tbl_epins', array('epin' => $epin), '*');
            if (!empty($pin)) {
                return $this->generate_pin();
            } else {
                return $epin;
            }
        }
    }


    // function test_level_income($sponser_id, $activated_id, $package_income = '20,10,5,5,5,2,2') {
    //     $incomes = explode(',', $package_income);
    //     foreach ($incomes as $key => $income) {
    //         $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $sponser_id), 'id,user_id,sponser_id,paid_status');
    //         if (!empty($sponser)) {
    //             if ($sponser['paid_status'] == 1) {
    //                 $LevelIncome = array(
    //                     'user_id' => $sponser['user_id'],
    //                     'amount' => $income,
    //                     'type' => 'level_income',
    //                     'description' => 'Level Income from Activation of Member ' . $activated_id . ' At level ' . ($key + 2),
    //                 );
    //                 pr($LevelIncome);
    //                 //$this->User_model->add('tbl_income_wallet', $LevelIncome);
    //             }
    //             $sponser_id = $sponser['sponser_id'];
    //         }
    //     }
    // }


    function level_income($sponser_id, $activated_id, $package_income) {
        $incomes = explode(',', $package_income);
        foreach ($incomes as $key => $income) {
            $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $sponser_id), 'id,user_id,sponser_id,paid_status');
            if (!empty($sponser)) {
                if ($sponser['paid_status'] == 1) {
                    $LevelIncome = array(
                        'user_id' => $sponser['user_id'],
                        'amount' => $income,
                        'type' => 'level_income',
                        'description' => 'Level Income from Activation of Member ' . $activated_id . ' At level ' . ($key + 2),
                    );
                    $this->User_model->add('tbl_income_wallet', $LevelIncome);
                }
                $sponser_id = $sponser['sponser_id'];
            }
        }
    }

    public function CookieBasedTracking() {
        if (is_logged_in()) {
            $response = array();
            $response['records'] = $this->User_model->count_cookies($this->session->userdata['user_id']);
            $this->load->view('cookie_based_tracking', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function withdraw_history() {
        if (is_logged_in()) {
            $response = array();
            $response['header'] = 'Withdraw Summary';
            $response['transactions'] = $this->User_model->get_records('tbl_withdraw', array('user_id' => $this->session->userdata['user_id']), '*');
            $this->load->view('transaction_history', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function bank_transfer_summary() {
        if (is_logged_in()) {
            $response = array();
            $response['header'] = 'Bank Transfer Summary';
            $response['transactions'] = $this->User_model->get_records('tbl_money_transfer', array('user_id' => $this->session->userdata['user_id']), '*');
            $this->load->view('bank_transfer_summary', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function tds_charges() {
        if (is_logged_in()) {
            $response = array();
            $response['header'] = 'TDS Charges';
            $response['transactions'] = $this->User_model->get_records('tbl_withdraw', array('user_id' => $this->session->userdata['user_id']), '*');
            $this->load->view('tds_charges', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function forgot_password() {
        $response = array();
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data = $this->security->xss_clean($this->input->post());
            $user = $this->User_model->get_single_record('tbl_users', ' user_id = "' . $data['user_id'] . '" or email = "' . $data['user_id'] . '"', 'name,last_name,user_id,email,master_key,password');
            if (!empty($user)) {
                $message = "Dear " . $user['name'] . '  password for Your Accountt is ' . $user['password'] . ' and Txn. Password is  '.$user['master_key'].' ' . base_url();
                $response['message'] = 'One Time Password Sent on Your Phone Please check';
                // $this->send_email($user['email'], 'Security Alert', $message);
                notify_user($user['user_id'], $message);
                $this->session->set_flashdata('message', 'Password Sent On Your Registered Phone Number');
            } else {
                $this->session->set_flashdata('message', 'Invalid User ID');
            }
        }
        $this->load->view('forgot_password', $response);
    }

    public function send_email($email = '349kuldeep@gmail.com', $subject = "Security Alert", $message = 'hello i am here') {
        date_default_timezone_set('Asia/Singapore');
        $this->load->library('email');
        $this->email->from('info@dway.com', 'DwaySwotfish');
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($message);

        $this->email->send();
    }

}
