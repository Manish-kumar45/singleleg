<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('User_model'));
        $this->load->helper(array('user', 'birthdate', 'security', 'email'));
    }

    public function index() {
        if (is_logged_in()) {
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            $response['roi'] = $this->User_model->get_records('tbl_roi', 'user_id = "'.$this->session->userdata['user_id'].'"', '*');
            $response['popup'] = $this->User_model->get_single_record('tbl_popup',"id != '' order by id desc limit 1", '*');
            // $response['rank_bonus'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "' . $this->session->userdata['user_id'] . '" and type = "rank_bonus"', 'ifnull(sum(amount),0) as rank_bonus');

            // $response['pool'] = $this->User_model->get_single_record('tbl_pool', 'user_id = "' . $this->session->userdata['user_id'] . '"', '*');

            // $response['pool_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "' . $this->session->userdata['user_id'] . '" and type = "pool_income"', 'ifnull(sum(amount),0) as pool_income');
            /**Comment by kush */
            $response['today_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "' . $this->session->userdata['user_id'] . '" and date(created_at) = date(now()) and amount > 0 and type != "bank_transfer" and type != "repurchase_income"', 'ifnull(sum(amount),0) as today_income');
            $response['direct_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "' . $this->session->userdata['user_id'] . '" and type = "direct_income"', 'ifnull(sum(amount),0) as direct_income');
            $response['level_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "' . $this->session->userdata['user_id'] . '" and type = "level_income"', 'ifnull(sum(amount),0) as level_income');
           $response['single_leg'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "' . $this->session->userdata['user_id'] . '" and type = "single_leg"', 'ifnull(sum(amount),0) as single_leg');
           $response['leadership_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "' . $this->session->userdata['user_id'] . '" and type = "leadership_income"', 'ifnull(sum(amount),0) as leadership_income');
           $response['reward_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "' . $this->session->userdata['user_id'] . '" and type = "reward_income"', 'ifnull(sum(amount),0) as reward_income');
           $response['total_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "' . $this->session->userdata['user_id'] . '" and amount > 0 and type != "bank_transfer" and type != "repurchase_income"', 'ifnull(sum(amount),0) as total_income');
           $response['royalty_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "'.$this->session->userdata['user_id'].'"  and type = "royalty_income"', 'ifnull(sum(amount),0) as royalty_income');
           $response['gold_royalty_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "'.$this->session->userdata['user_id'].'"  and type = "gold_royalty_income"', 'ifnull(sum(amount),0) as gold_royalty_income');
           $response['repurchase_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "'.$this->session->userdata['user_id'].'"  and type = "repurchase_income"', 'ifnull(sum(amount),0) as repurchase_income');
           $response['income_balance'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "' . $this->session->userdata['user_id'] . '"', 'ifnull(sum(amount),0) as income_balance');

           /**Comment by kush */
            // $response['total_repurchase_income'] = $this->User_model->get_single_record('tbl_repurchase_income', 'user_id = "'.$this->session->userdata['user_id'].'"', 'ifnull(sum(amount),0) as total_repurchase_income');
            // $response['surprise_profit_income'] = $this->User_model->get_single_record('tbl_surprise_wallet', 'user_id = "'.$this->session->userdata['user_id'].'"', 'ifnull(sum(amount),0) as surprise_profit_income');
            $response['total_pins'] = $this->User_model->get_single_record('tbl_epins', array('user_id' => $this->session->userdata['user_id']), 'ifnull(count(id),0) as sum');
            $response['transaferred_pins'] = $this->User_model->get_single_record('tbl_epins', array('user_id' => $this->session->userdata['user_id'], 'status' => 2), 'ifnull(count(id),0) as sum');
            $response['used_pins'] = $this->User_model->get_single_record('tbl_epins', array('user_id' => $this->session->userdata['user_id'], 'status' => 1), 'ifnull(count(id),0) as sum');

            $response['team'] = $this->User_model->get_single_record('tbl_downline_count', 'user_id = "' . $this->session->userdata['user_id'] . '"', 'ifnull(count(id),0) as team');
            $response['paid_directs'] = $this->User_model->get_single_record('tbl_users', 'sponser_id = "' . $this->session->userdata['user_id'] . '" and paid_status = 1', 'ifnull(count(id),0) as paid_directs');
            $response['free_directs'] = $this->User_model->get_single_record('tbl_users', 'sponser_id = "' . $this->session->userdata['user_id'] . '"  and paid_status = 0', 'ifnull(count(id),0) as free_directs');
            // $response['requested_fund'] = $this->User_model->get_single_record('tbl_payment_request', 'user_id = "' . $this->session->userdata['user_id'] . '" ', 'ifnull(sum(amount),0) as requested_fund');
            $response['wallet_balance'] = $this->User_model->get_single_record('tbl_wallet', 'user_id = "' . $this->session->userdata['user_id'] . '" ', 'ifnull(sum(amount),0) as wallet_balance');
            // $response['released_fund'] = $this->User_model->get_single_record('tbl_payment_request', 'user_id = "' . $this->session->userdata['user_id'] . '" and status = 1', 'ifnull(sum(amount),0) as released_fund');
            $response['total_withdrawal'] = $this->User_model->get_single_record('tbl_withdraw', 'user_id = "' . $this->session->userdata['user_id'] . '"', 'ifnull(sum(amount),0) as total_withdrawal');
            $response['single_leg_downline'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $response['user']['user_id'] ,'paid_status' => 1), 'total_user_after_paid as single_leg_downline');
            $response['bank_transfer'] = $this->User_model->get_single_record('tbl_money_transfer', array('user_id' => $response['user']['user_id']), 'ifnull(sum(payable_amount),0) as bank_transfer');
            // $response['recycle_ids'] = $this->User_model->get_records('tbl_repurchase_income', 'user_id = "'.$this->session->userdata['user_id'].'" and type = "magic_user_registration"', '*');
            $response['silverRoyalty'] = $this->User_model->get_records('tbl_users', array('directs >=' => 25,'directs <' => '50'), 'user_id,name'); ///$this->User_model->top_directs();
            $response['goldRoyalty'] = $this->User_model->get_records('tbl_users', array('directs >=' => 50), 'user_id,name');
            $response['news'] = $this->User_model->get_records('tbl_news', [],'*'); ///$this->User_model->top_directs();
            // $response['team_unpaid'] = $this->User_model->calculate_team($this->session->userdata['user_id'], 0);
            // $response['team_paid'] = $this->User_model->calculate_team($this->session->userdata['user_id'], 1);
            // $response['rr_users'] = $royalty_achievers;
            $i = 0;
            $response['leadershipAchievers'] = [];
            $royalty_achievers = $this->User_model->get_records('tbl_users',array('directs >=' => '5'),'*');
            foreach($royalty_achievers as $key => $achiever){
                $levelDirect = $this->User_model->get_single_record('tbl_users',array('sponser_id' => $achiever['user_id'],'directs >=' => '5'),'count(id) as record');
                if($levelDirect['record'] >= '5'){
                    $response['leadershipAchievers'][$i] = $achiever;
                }
                $i++;
            }
            // pr($response,true);
            $this->load->view('header', $response);
            $this->load->view('index', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function Referral() {
        if (is_logged_in()) {
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            $response['today_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = ' . $this->session->userdata['user_id'] . ' and date(created_at) = date(now()', 'ifnull(sum(amount),0) as today_income');
            $response['task_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = ' . $this->session->userdata['user_id'] . ' and type = "task_income"', 'ifnull(sum(amount),0) as task_income');
            $response['direct_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = ' . $this->session->userdata['user_id'] . ' and type = "direct_income"', 'ifnull(sum(amount),0) as direct_income');
            $this->load->view('header', $response);
            $this->load->view('refferal', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function sample() {
        if (is_logged_in()) {
            $response = array();
            $this->load->view('header', $response);
            $this->load->view('index', $response);
            $this->load->view('footer', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function login() {
        redirect('Dashboard/User/MainLogin');
    }

    public function MainLogin() {
        $response['message'] = '';
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data = $this->security->xss_clean($this->input->post());
            $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $data['user_id'], 'password' => $data['password']), 'id,user_id,role,name,email,paid_status,disabled');
            if (!empty($user)) {
                if ($user['disabled'] == 0) {
                    $this->session->set_userdata('user_id', $user['user_id']);
                    $this->session->set_userdata('role', $user['role']);
                    redirect('Dashboard/User/');
                } else {
                    $response['message'] = 'This Account Is Blocked Please Contact to Administrator';
                }
            } else {
                $response['message'] = 'Invalid Credentials';
            }
        }
        $this->load->view('main_login', $response);
    }

    public function Success() {
        $response['message'] = 'Dear User Your Account Successfully created on test <br> Now You Can Login with <br>User ID :kkk <br> Password :`1234';
        $this->load->view('success', $response);
    }

    public function register_cron(){
        die();
        for($i = 1 ;$i <= 25 ; $i++){
            $user_id = $this->getUserIdForRegister();
            $userData['user_id'] = $user_id; //'AMAZING'.$id_number;
            $userData['sponser_id'] = 'admin';
            $userData['name'] = 'Profit Venture'.$i;
            $userData['phone'] = '123123123';
            $userData['password'] = rand(1000, 9999);
            $userData['master_key'] = rand(1000, 9999);
            $res = $this->User_model->add('tbl_users', $userData);
            $res = $this->User_model->add('tbl_bank_details', array('user_id' => $userData['user_id']));
            if ($res) {
                $this->add_counts($userData['user_id'], $userData['user_id'], $level = 1);
                echo $i .'New User Registered Successfully<br>';
            } else {
                echo $i .'Error while Registraion please try Again<br>';
            }
            $this->ActivateAccount($user_id);
        }
        redirect('Admin/');
    }
    public function ActivateAccount($user_id){
        $user = $this->User_model->get_single_record('tbl_users',['user_id' => $user_id],'id,user_id,sponser_id');
        $package = $this->User_model->get_single_record('tbl_package',[],'id,price');
        $topupData = array(
            'paid_status' => 1,
            'package_id' => $package['id'],
            'package_amount' => $package['price'],
            'topup_date' => date('Y-m-d H:i:s'),
            // 'capping' => $package['capping'],
        );
        $this->User_model->update('tbl_users', array('user_id' => $user_id), $topupData);
        $this->User_model->update_directs($user['sponser_id']);
        $this->User_model->total_team_update($user['id']);
        // $this->calculate_waste_points();
        $this->add_team_counts($user['user_id'], $user['user_id']);
    }


    function add_team_counts($user_name = 'DW56497', $downline_id = 'DW56497') {
        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_name), $select = 'sponser_id,user_id');
        if ($user['sponser_id'] != '') {
            $this->User_model->update_team_count('paid_team_count', $user['sponser_id']);
            $user_name = $user['sponser_id'];
            $this->add_team_counts($user_name, $downline_id);
        }
    }

    public function Register() {

        $response = array();
        $sponser_id = $this->input->get('sponser_id');
        if ($sponser_id == '') {
            $sponser_id = '';
        }
        $response['sponser_id'] = $sponser_id;
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->form_validation->set_rules('sponser_id', 'Sponser ID', 'trim|required|xss_clean');
            $this->form_validation->set_rules('phone', 'Phone', 'trim|required|numeric|xss_clean');
            $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
            // $this->form_validation->set_rules('pan', 'PAN ', 'trim|required|xss_clean');
            // $this->form_validation->set_rules('aadhar', 'Aadhar', 'trim|numeric|required|min_length[12]|max_length[12]|xss_clean');
            // $this->form_validation->set_rules('nominee_name', 'Nominee Name', 'trim|required|xss_clean');
            // $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', validation_errors());
                $this->load->view('register', $response);
            } else {
                $sponser_id = $this->input->post('sponser_id');
                $response['sponser_id'] = $sponser_id;
                $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $sponser_id), 'user_id,paid_status');
                if (!empty($sponser)) {
                    $free_sponser = $this->User_model->get_single_record('tbl_users' , array('sponser_id' => $sponser_id , 'paid_status' => 0) ,'ifnull(count(id),0) as free_direct');
                    if($free_sponser['free_direct'] < 5000000){
                        if ($sponser['paid_status'] == 1) {
                            if(strlen($this->input->post('phone')) == 10){
                                $user_id = $this->getUserIdForRegister();
                                $userData['user_id'] = $user_id; //'AMAZING'.$id_number;
                                $userData['sponser_id'] = $sponser_id;
                                $userData['name'] = $this->input->post('name');
                                $userData['phone'] = $this->input->post('phone');
                                $userData['password'] = rand(1000, 9999);
                                $userData['master_key'] = rand(1000, 9999);
                                $res = $this->User_model->add('tbl_users', $userData);
                                $bankDetails['user_id'] = $userData['user_id'];
                                // $bankDetails['pan'] = $this->input->post('pan');
                                // $bankDetails['aadhar'] = $this->input->post('aadhar');
                                // $bankDetails['nominee_name'] = $this->input->post('nominee_name');
                                $res = $this->User_model->add('tbl_bank_details', $bankDetails);
                                if ($res) {
                                    $this->add_counts($userData['user_id'], $userData['user_id'], $level = 1);
                                    $sms_text = 'Dear ' . $userData['name'] . ', Your Account Successfully created. User ID :  ' . $userData['user_id'] . ' Password :' . $userData['password'] . ' Transaction Password:' . $userData['master_key'] . ' ' . base_url();
                                    notify_user($userData['user_id'], $sms_text);
                                    $response['message'] = 'Dear ' . $userData['name'] . ', Your Account Successfully created. <br>User ID :  ' . $userData['user_id'] . ' <br> Password :' . $userData['password'] . ' <br> Transaction Password:' . $userData['master_key'];
                                    $this->load->view('success', $response);
                                } else {
                                    $this->session->set_flashdata('error', 'Error while Registraion please try Again');
                                    $response['message'] = 'Error while Registraion please try Again';
                                    $this->load->view('register', $response);
                                }
                            }else{
                                $this->session->set_flashdata('error', 'Maximum digits are 10 for Phone Number');
                                $this->load->view('register', $response);
                            }
                        } else {
                            $this->session->set_flashdata('error', 'Sponser Account is Free');
                            $this->load->view('register', $response);
                        }

                    }else{
                        $this->session->set_flashdata('error', 'This Sponser Have Already More than Five Free Directs');
                        $this->load->view('register', $response);
                    }
                } else {
                    $this->session->set_flashdata('error', 'Invalid Sponser ID');
                    $this->load->view('register', $response);
                }
            }
        } else {
            $this->load->view('register', $response);
        }
    }

    public function getUserIdForRegister() {
        $user_id = 'WWk' . rand(10000, 99999);
        $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), 'user_id,name');
        if (!empty($sponser)) {
            return $this->getUserIdForRegister();
        } else {
            return $user_id;
        }
    }
    function add_counts($user_name = 'DW56497', $downline_id = 'DW56497', $level) {
        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_name), $select = 'sponser_id,user_id');
        if ($user['sponser_id'] != '') {
            // if ($user['position'] == 'L') {
            //     $count = array('left_count' => ' left_count + 1');
            //     $c = 'left_count';
            // } else if ($user['position'] == 'R') {
            //     $c = 'right_count';
            //     $count = array('right_count' => ' right_count + 1');
            // } else {
            //     return;
            // }
            // $this->User_model->update_count($c, $user['upline_id']);
            $downlineArray = array(
                'user_id' => $user['sponser_id'],
                'downline_id' => $downline_id,
                'position' => '',
                'created_at' => 'CURRENT_TIMESTAMP',
                'level' => $level,
            );
            $this->User_model->add('tbl_downline_count', $downlineArray);
            $user_name = $user['sponser_id'];
            $this->add_counts($user_name, $downline_id, $level + 1);
        }
    }

    public function logout() {
        $this->session->unset_userdata(array('user_id', 'role'));
        redirect('Dashboard/User/login');
    }

    public function Profile() {
        if (is_logged_in()) {
            $response = array();
            $response['active_tab'] = 'profile';
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                // $this->session->set_flashdata('error', '<p style="color:red;">This service not available</p>');
                // redirect('Dashboard/User/profile');
                // exit;
                if ($data['form_type'] == 'profile_form') {
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), $select = 'master_key');
                    // $Userdata['name'] = $data['name'];
                    if ($user['master_key'] == $data['master_key']) {
                        $Userdata['last_name'] = $data['last_name'];
                        $Userdata['address'] = $data['address'];
                        $Userdata['master_key'] = $data['master_key'];
                        $Userdata['country'] = $data['country'];
                        $Userdata['email'] = $data['email'];
                        $Userdata['postal_code'] = $data['postal_code'];
                       // $Userdata['phone'] = $data['phone'];
                        $updres = $this->User_model->update('tbl_users', array('user_id' => $this->session->userdata['user_id']), $Userdata);
                        if ($updres == true) {
                            $this->session->set_flashdata('error', 'Details Updated Successfully');
                        } else {
                            $this->session->set_flashdata('error', 'There is an error while updating profile details Please try Again ..');
                        }
                    } else {
                        $this->session->set_flashdata('error', 'Invalid Transaction Password');
                    }
                } elseif ($data['form_type'] == 'image_form') {
                    if (!empty($_FILES['userfile']['name'])) {
                        $config['upload_path'] = './uploads/';
                        $config['allowed_types'] = 'gif|jpg|png|pdf';
                        $config['file_name'] = 'profile' . time();
                        $this->load->library('upload', $config);
                        if (!$this->upload->do_upload('userfile')) {
                            $this->session->set_flashdata('error', $this->upload->display_errors());
                        } else {
                            $fileData = array('upload_data' => $this->upload->data());
                            $userData['image'] = $fileData['upload_data']['file_name'];
                            $updres = $this->User_model->update('tbl_users', array('user_id' => $this->session->userdata['user_id']), $userData);
                            if ($updres == true) {
                                $this->session->set_flashdata('error', 'Image Updated Successfully');
                            } else {
                                $this->session->set_flashdata('error', 'There is an error while updating Image Please try Again ..');
                            }
                        }
                    } else {
                        $this->session->set_flashdata('error', 'Please Choose An image to upload');
                    }
                }
            }
            $userinfo = userinfo();
            $countries = $this->User_model->get_records('countries', array(), '*');
            // $response['stateArr'] = $this->User_model->get_records('states', array('country_id' => $userinfo->country), '*');
            // if (empty($userinfo->state)) {
            //     $state_id = $response['stateArr'][0]['id'];
            // } else {
            //     $state_id = $userinfo->state;
            // }
//            pr($userinfo, true);
            // $response['cityArr'] = $this->User_model->get_records('cities', array('state_id' => $state_id), '*');
            // $countryN = array();
            // $response['message'] = '';
            foreach ($countries as $key => $country)
                $countryN[$country['id']] = $country['name'];
            $response['countries'] = $countryN;
//            pr($response);
             $response['header'] = 'Profile Update'; 
            $this->load->view('profile_update', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function password_reset() {
        if (is_logged_in()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $cpassword = $data['cpassword'];
                $npassword = $data['npassword'];
                $vpassword = $data['vpassword'];
                if($data['otp'] == $_SESSION['otp'] && !empty($_SESSION['otp'])){
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), 'id,user_id,password');
                    if ($npassword != $vpassword) {
                        $this->session->set_flashdata('error', 'Verify Password Does Not Match');
                    } elseif ($cpassword != $user['password']) {
                        $this->session->set_flashdata('error', 'Wrong Current Password');
                    } else {
                        $updres = $this->User_model->update('tbl_users', array('user_id' => $this->session->userdata['user_id']), array('password' => $vpassword));
                        if ($updres == true) {
                            $this->session->set_flashdata('error', 'Password Updated Successfully');
                        } else {
                            $this->session->set_flashdata('error', 'There is an error while Changing Password Please Try Again');
                        }
                    }
                }else{
                    $this->session->set_flashdata('error', 'Please enter valid OTP');
                }
            }
            $this->load->view('password_reset', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function trans_password() {
        if (is_logged_in()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $cpassword = $data['cpassword'];
                $npassword = $data['npassword'];
                $vpassword = $data['vpassword'];
                $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), 'id,user_id,password,master_key');
                if ($data['otp'] == $_SESSION['otp'] && !empty($_SESSION['otp'])) {
                    if ($npassword != $vpassword) {
                        $this->session->set_flashdata('error', 'Verify Transaction Password Does Not Match');
                    } elseif ($cpassword != $user['master_key']) {
                        $this->session->set_flashdata('error', 'Wrong Current Transaction Password');
                    } else {
                        $updres = $this->User_model->update('tbl_users', array('user_id' => $this->session->userdata['user_id']), array('master_key' => $vpassword));
                        if ($updres == true) {
                            $response = $this->session->set_flashdata('error', 'Transaction Password Updated Successfully');
                        } else {
                            $this->session->set_flashdata('error', 'There is an error while Changing Transaction Password Please Try Again');
                        }
                    }
                }else{
                    $response = $this->session->set_flashdata('error', 'Please enter valid otp');
                }
            }
            $this->load->view('trans_password', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function id_card() {
        if (is_logged_in()) {
            $response = array();
            $this->load->view('id_card', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function BankDetails() {
        if (is_logged_in()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $data = html_escape($data);
                $this->form_validation->set_rules('bank_name', 'Bank Name', 'trim|required|xss_clean');
                $this->form_validation->set_rules('bank_account_number', 'Bank Account Number', 'trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('ifsc_code', 'Ifsc Code', 'trim|required|xss_clean');
                $this->form_validation->set_rules('master_key', 'Txn. Password', 'trim|required|xss_clean');
                $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
                if ($user['master_key'] == $data['master_key']) {
                    if ($this->form_validation->run() != FALSE) {
                        $userData['bank_account_number'] = $data['bank_account_number'];
                        $userData['bank_name'] = $data['bank_name'];
                        $userData['account_holder_name'] = $data['account_holder_name'];
                        $userData['ifsc_code'] = $data['ifsc_code'];
                        $userData['aadhar'] = $data['aadhar'];
                        $userData['pan'] = $data['pan'];
                        $userData['kyc_status'] = 1;
                        $updres = $this->User_model->update('tbl_bank_details', array('user_id' => $this->session->userdata['user_id']), $userData);
                        if ($updres == true) {
                            $this->session->set_flashdata('error', 'Details Updated Successfully');
                        } else {
                            $this->session->set_flashdata('error', 'There is an error while updating Bank details Please try Again ..');
                        }
                    } else {
                        $this->session->set_flashdata('error', 'Validation Failed');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Invalid Transaction Password');
                }
            }
            $response['user_bank'] = (object) $this->User_model->get_single_record('tbl_bank_details', array('user_id' => $this->session->userdata['user_id']), '*');
            $this->load->view('bank_details', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function UploadProof() {
        if (is_logged_in()) {
            $response = array();
            $response['csrfName'] = $this->security->get_csrf_token_name();
            $response['csrfHash'] = $this->security->get_csrf_hash();

            if (!empty($_FILES['userfile'])) {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'gif|jpg|png|pdf';
                $config['max_size'] = 100000;
                $config['file_name'] = 'id_proof' . time();
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('userfile')) {
                    $response['message'] = $this->upload->display_errors();
                    // $this->session->set_flashdata('error', $this->upload->display_errors());
                    $response['success'] = '0';
                } else {
                    $type = $this->input->post('proof_type');
                    $fileData = array('upload_data' => $this->upload->data());
                    $userData[$type] = $fileData['upload_data']['file_name'];
                    $updres = $this->User_model->update('tbl_bank_details', array('user_id' => $this->session->userdata['user_id']), $userData);
                    if ($updres == true) {
                        $response['success'] = '1';
                        $response['message'] = 'Proof Uploaded Successfully';
                    } else {
                        $response['success'] = '0';
                        $response['message'] = 'There is an error while updating Bank details Please try Again ..';
                    }
                }
            } else {
                $response['message'] = 'There is an error while updating Bank details Proof Please try Again ..';
                $response['success'] = '0';
            }
            echo json_encode($response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function PlaceParticipants() {
        if (is_logged_in()) {
            $response = array();
            $response['header'] = 'Place Participants';
            $response['users'] = $this->User_model->get_records('tbl_users', array('sponser_id' => $this->session->userdata['user_id'], 'is_placed' => 0), 'id,user_id,sponser_id,role,name,email,phone,upline_id,created_at');
            $this->load->view('place_participants', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function Directs() {
        if (is_logged_in()) {
            $response = array();
            $response['header'] = 'Direct Participants';
            $response['users'] = $this->User_model->get_records('tbl_users', array('sponser_id' => $this->session->userdata['user_id']), 'id,user_id,sponser_id,role,name,last_name,email,paid_status,phone,upline_id,created_at');
            // foreach ($response['users'] as $key => $user) {
            //     $response['users'][$key]['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['user_id']), 'id,user_id,sponser_id,role,first_name,last_name,email,phone,upline_id,created_at');
            // }
            $this->load->view('directs', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function LeaderShipTeamDetail() {
        if (is_logged_in()) {
            $response = array();
            $response['header'] = 'LeaderShip Participants';
            $response['users'] = $this->User_model->leadership_members($this->session->userdata['user_id']);
            // foreach ($response['users'] as $key => $user) {
            //     $response['users'][$key]['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['user_id']), 'id,user_id,sponser_id,role,first_name,last_name,email,phone,upline_id,created_at');
            // }
            $this->load->view('leadership_team_detail', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function Downline() {
        if (is_logged_in()) {
            $response = array();
            $response['header'] = 'Downline Participants';
            $response['users'] = $this->User_model->get_records('tbl_downline_count', array('user_id' => $this->session->userdata['user_id']), 'id,downline_id,level');
            foreach ($response['users'] as $key => $user) {
                $response['users'][$key]['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['downline_id']), 'id,user_id,sponser_id,role,name,email,phone,paid_status,upline_id,created_at');
            }
            $this->load->view('downline', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    // public function rightParticipants() {
    //     if (is_logged_in()) {
    //         $response = array();
    //         $response['header'] = 'Left Participants';
    //         $response['users'] = $this->User_model->get_records('tbl_user_positions', array('sponser_id' => $this->session->userdata['user_id'], 'position' => 'R'), 'id,user_id,sponser_id,upline_id,position');
    //         foreach ($response['users'] as $key => $user) {
    //             $response['users'][$key]['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['user_id']), 'id,user_id,sponser_id,role,first_name,last_name,email,phone,upline_id,created_at');
    //         }
    //         $this->load->view('directs', $response);
    //     } else {
    //         redirect('Dashboard/User/login');
    //     }
    // }

    public function income($type) {
        if (is_logged_in()) {
            $response = array();
            $response['header'] = get_income_name($type); //ucwords(str_replace('_', ' ', $type));
            $response['total_income'] = $this->User_model->get_single_record('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id'], 'type' => $type), 'ifnull(sum(amount),0) as total_income');
            $response['user_incomes'] = $this->User_model->get_records('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id'], 'type' => $type), 'id,user_id,amount,type,description,created_at');
            $this->load->view('incomes', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function Magicincome($type) {
        if (is_logged_in()) {
            $response = array();
            $response['header'] = 'Magic ' . ucwords(str_replace('_', ' ', $type));
            $response['user_incomes'] = $this->User_model->get_records('tbl_repurchase_income', array('user_id' => $this->session->userdata['user_id'], 'type' => $type), 'id,user_id,amount,type,description,created_at');
            $this->load->view('incomes', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function Magicincome_ledgar() {
        if (is_logged_in()) {
            $response = array();
            $response['header'] = 'Magic Income Ledgar';
            $response['total_income'] = $this->User_model->get_single_record('tbl_repurchase_income', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as total_income');
            $response['user_incomes'] = $this->User_model->get_records('tbl_repurchase_income', array('user_id' => $this->session->userdata['user_id']), 'id,user_id,amount,type,description,created_at');
            $this->load->view('incomes', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function income_ledgar() {
        if (is_logged_in()) {
            $response = array();
            $response['header'] = 'Income Ledgar';
            $response['total_income'] = $this->User_model->get_single_record('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as total_income');
            $response['user_incomes'] = $this->User_model->get_records('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id']), 'id,user_id,amount,type,description,created_at');
            $this->load->view('incomes', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function suprise_profit() {
        if (is_logged_in()) {
            $response = array();
            $response['header'] = 'Suprise Company Profit Sharing Income';
            $response['total_income'] = $this->User_model->get_single_record('tbl_surprise_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as total_income');
            $response['user_incomes'] = $this->User_model->get_records('tbl_surprise_wallet', array('user_id' => $this->session->userdata['user_id']), '*');
            $this->load->view('suprise_incomes', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function purchase_history() {
        if (is_logged_in()) {
            $response = array();
            $response['header'] = 'Shopping History';
            $response['orders'] = $this->User_model->get_records('tbl_orders', array('user_id' => $this->session->userdata['user_id']), '*');
            $i = 0;
            $this->load->view('purchase_history', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function Tree($user_id) {
        if (is_logged_in()) {
            $response = array();
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), 'id,user_id,sponser_id,role,name,first_name,last_name,email,phone,paid_status,created_at');
            $response['users'] = $this->User_model->get_records('tbl_users', array('sponser_id' => $user_id), 'id,user_id,sponser_id,role,name,first_name,last_name,email,phone,paid_status,created_at');
            foreach ($response['users'] as $key => $directs) {
                $response['users'][$key]['sub_directs'] = $this->User_model->get_records('tbl_users', array('sponser_id' => $directs['user_id']), 'id,user_id,sponser_id,role,name,first_name,last_name,email,phone,paid_status,created_at');
            }
            $this->load->view('tree', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function Pool($user_id) {
        if (is_logged_in()) {
            $response = array();
            $response['user'] = $this->User_model->get_single_record('tbl_pool', array('user_id' => $user_id), '*');
            $response['users'] = $this->User_model->get_records('tbl_pool', array('upline_id' => $user_id), '*');
            foreach ($response['users'] as $key => $directs) {
                $response['users'][$key]['user_info'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $directs['user_id']), 'id,user_id,sponser_id,role,name,first_name,last_name,email,phone,paid_status,created_at');
                $response['users'][$key]['l2'] = $this->User_model->get_records('tbl_pool', array('upline_id' => $directs['user_id']), 'id,user_id');
            }
            // pr($response,true);
            $this->load->view('pool', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function Genelogy() {
        if (is_logged_in()) {
            $response = array();
            $response['directs'] = $this->User_model->get_records('tbl_users', array('sponser_id' => $this->session->userdata['user_id']), 'id,user_id,sponser_id');
            $response['directs'] = $this->User_model->get_records('tbl_users', array('sponser_id' => $this->session->userdata['user_id']), 'id,user_id,sponser_id');
            $this->load->view('genelogy', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function genelogy_users($user_id) {
        if (is_logged_in()) {
            $response = array();
            $response['directs'] = $this->User_model->get_records('tbl_users', array('sponser_id' => $user_id), 'id,user_id,sponser_id');
            echo json_encode($response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function image_upload() {
        if (is_logged_in()) {
            $response = array();
            $data = $_POST['image'];
            list($type, $data) = explode(';', $data);
            list(, $data) = explode(',', $data);

            $data = base64_decode($data);
            $imageName = time() . '.png';
            file_put_contents(APPPATH . '../uploads/' . $imageName, $data);
            $updres = $this->User_model->update('tbl_users', array('user_id' => $this->session->userdata['user_id']), array('image' => $imageName));
            $response['message'] = 'Image uploaed Succesffully';
            echo json_encode($response);
            exit();
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function get_states($country_id) {
        $countries = $this->User_model->get_records('states', array('country_id' => $country_id), '*');
        echo json_encode($countries);
    }

    public function get_city($state_id) {
        $countries = $this->User_model->get_records('cities', array('state_id' => $state_id), '*');
        echo json_encode($countries);
    }

    public function get_user($user_id = '') {
        $response = array();
        $response['success'] = 0;
        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), 'id,user_id,sponser_id,role,name,first_name,last_name,email,phone,paid_status,created_at');
        if (!empty($user)) {
            echo $user['name'];
        } else {
            echo 'User Not Found';
        }
    }

    public function test_rollup() {
        $this->rollup_personal_business($sponser_id = 'SG10008', $amount = '897', $share = 4, $sender_id = 'SG10015', 24);
    }

    public function credit_income($user_id, $amount, $type, $description) {
        $incomeArr = array(
            'user_id' => $user_id,
            'amount' => $amount,
            'type' => $type,
            'description' => $description,
        );
        $this->User_model->add('tbl_income_wallet', $incomeArr);
    }

    public function Validate_promo_code($code) {
        $res = array();
        $res['success'] = 0;
        $promo_code = $this->User_model->get_single_record('tbl_promo_codes', array('promo_code' => $code), '*');
        if (!empty($promo_code)) {
            $res['message'] = 'Promo Code Validated Now ' . $promo_code['discount'] . ' % Discount is Applied';
            $res['success'] = 1;
        } else {
            $res['message'] = 'Invalid Promo Code';
        }
        echo json_encode($res);
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
