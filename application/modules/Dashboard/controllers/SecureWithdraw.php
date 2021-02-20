<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class secureWithdraw extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('User_model'));
        $this->load->helper(array('user', 'birthdate', 'security', 'email'));
        $this->api_token = "165460673165638";
        // $this->api_user_id = ''; //'473';
    }

    public function index(){
    	echo ('undefined URL');
    }

    public function addBeneficiary(){
        if (is_logged_in()) {
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), 'id,user_id,name,phone,netbanking,email');
            $beneficiaryCount = $this->User_model->get_single_record('tbl_add_beneficiary', array('user_id' => $this->session->userdata['user_id']), 'count(id) as ids');
            // if($beneficiaryCount['ids'] == 0){
                // $response['status'] = 0;
                if ($this->input->server('REQUEST_METHOD') == 'POST') {
                    $data = $this->security->xss_clean($this->input->post());
                    $this->form_validation->set_rules('beneficiary_name', 'Beneficiary Name', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('beneficiary_account_no', 'Beneficiary Account Number', 'trim|required|numeric|xss_clean');
                    $this->form_validation->set_rules('beneficiary_ifsc', 'IFSC Code', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('beneficiary_mobile', 'Beneficiary Mobile', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('beneficiary_bank', 'Beneficiary Bank Name', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('beneficiary_branch', 'Beneficiary Bank Branch', 'trim|required|xss_clean');
                    if ($this->form_validation->run() != FALSE) {
                            $beneficiary_account_no = $this->User_model->get_single_record('tbl_add_beneficiary', array('user_id' => $this->session->userdata['user_id'], 'beneficiary_account_no' => $data['beneficiary_account_no']), 'beneficiary_account_no');
                            // if(empty($beneficiary_account_no['beneficiary_account_no'])){
                                $add_beneficiary = array('user_id' => $this->session->userdata['user_id'], 'beneficiary_name' => $data['beneficiary_name'], 'beneficiary_account_no' => $data['beneficiary_account_no'], 'beneficiary_ifsc' => $data['beneficiary_ifsc'], 'beneficiary_mobile' => $data['beneficiary_mobile'], 'account_ifsc' => $data['beneficiary_account_no'].'_'.$data['beneficiary_ifsc'], 'beneficiary_bank' => $data['beneficiary_bank'], 'beneficiary_branch' => $data['beneficiary_branch']);
                                $run = $this->User_model->add('tbl_add_beneficiary', $add_beneficiary);
                                if($run){
                                    $this->session->set_flashdata('message', 'Beneficiary Added Successfully!');
                                }else{
                                    $this->session->set_flashdata('message', 'ERROR:: While addeding Beneficiary!');
                                }
                            // }else{
                            //     $this->session->set_flashdata('message', 'ERROR:: This beneficiary is already added!');
                            // }
                        
                    }
                }
            // }
            // else{
            //     $response['status'] = 1;
            // }  
            $this->load->view('addBeneficiary', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }


    public function beneficiaryList(){
        if (is_logged_in()) {
            $response['beneficiary'] = $this->User_model->get_records('tbl_add_beneficiary', array('user_id' => $this->session->userdata['user_id']), '*');
            $this->load->view('beneficiaryList', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }


    public function withdrawAmount($beneficiry_id){
        if (is_logged_in()) {
            // redirect('Dashboard/User');
            // exit;
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            //$response['pool'] = $this->User_model->get_single_record('tbl_pool1', 'user_id = "' . $this->session->userdata['user_id'] . '"', '*');
            $response['beneficiary_id'] = $beneficiry_id;
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('otp', 'OTP', 'trim|required|xss_clean');
                $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('master_key', 'Master Key', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $checkBeneficary = $this->User_model->get_single_record('tbl_add_beneficiary', array('user_id' => $this->session->userdata['user_id'], 'account_ifsc' => $beneficiry_id), '*');
                    if(!empty($checkBeneficary)){
                        if($data['otp'] == $_SESSION['otp'] && !empty($_SESSION['otp'])){
                    // $user_id = $data['user_id'];
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
                    $kyc_status = $this->User_model->get_single_record('tbl_bank_details', array('user_id' => $this->session->userdata['user_id']), '*');
                    $withdraw_amount = $this->input->post('amount');
                    // $winto_user_id = $this->input->post('user_id');
                    $master_key = $this->input->post('master_key');
                    $balance = $this->User_model->get_single_record('tbl_income_wallet', ' user_id = "' . $this->session->userdata['user_id'] . '" AND type != "recharge_income"', 'ifnull(sum(amount),0) as balance');
                    $directs = $this->User_model->get_single_record('tbl_users', ' sponser_id = "' . $this->session->userdata['user_id'] . '" AND paid_status > 0', 'count(id) as ids');
                    $today_money = $this->User_model->get_single_record('tbl_money_transfer', ' user_id = "' . $this->session->userdata['user_id'] . '"  and status = "SUCCESS" and date(created_at) = date(now())', '*');
                    if(empty($today_money)){
                        if ($withdraw_amount >= 200) {
                            //if($directs['ids'] >= 2){
                            //if ($withdraw_amount % 500 == 0) {
                                if ($balance['balance'] >= $withdraw_amount) {
                                    if ($user['master_key'] == $master_key) {
                                        //if($kyc_status['kyc_status'] == 2){
                                            $transfer_amount = (round($data['amount'] * 85 / 100) - 0); // 10% IMPS charges including admin+tds
                                            //$transfer_amount = (round($data['amount']));
                                            $myorderid = $this->generate_order_id();
                                            $ch = curl_init();
                                            $timeout = 61;
                                            $b = explode('_',$beneficiry_id);
                                            $callBackUrl = base_url('Dashboard/SecureWithdraw/callBackUrl');
                                            $paramList = array('apikey' => $this->api_token,'mobileno' => $checkBeneficary['beneficiary_mobile'], 'beneficiary_account_no' => $checkBeneficary['beneficiary_account_no'], 'beneficiary_ifsc' => $checkBeneficary['beneficiary_ifsc'], 'amount' => $transfer_amount, 'orderid' => $myorderid, 'purpose' => 'BONUS', 'remarks' => title, 'callbackurl' => $callBackUrl);
                                            //print_r($paramList);
                                            $jsondata = $this->curlSetup($paramList);
                                            // pr($jsondata, true);
                                            if(!empty($jsondata)){  
                                                if($jsondata['status'] != 'FAILED'){
                                                $DirectIncome = array(
                                                        'user_id' => $this->session->userdata['user_id'],
                                                        'amount' => -$withdraw_amount,
                                                        'type' => 'bank_transfer',
                                                        'description' => 'Bank Transfer',
                                                    );
                                                    $this->User_model->add('tbl_income_wallet', $DirectIncome);
                                                }
                                                if($jsondata['status'] == 'ACCEPTED' || $jsondata['status'] == 'SUCCESS'){
                                                    $transactionArr = array(
                                                        'user_id' => $this->session->userdata['user_id'],
                                                        'beneficiaryid' => $jsondata['beneficiaryid'],
                                                        'amount' => $transfer_amount,
                                                        'status' => $jsondata['status'],
                                                        'joloorderid' => $jsondata['txid'],
                                                        'time' => $jsondata['time'],
                                                        'desc' => $jsondata['desc'],
                                                        'orderid' => $myorderid,
                                                        'payable_amount' => $withdraw_amount,
                                                    );
                                                    $this->User_model->add('tbl_money_transfer', $transactionArr);
                                                    $message = 'Dear '.$user['name'].' your withdrawal Rs.'.$withdraw_amount.' have been successful deposit into your account by '.title.'. Thanks';
                                                    notify_user($this->session->userdata['user_id'],$message);
                                                    // $this->session->set_flashdata('message', 'Transaction Completed Successfully');
                                                    $this->session->set_flashdata('message', $jsondata['desc']);
                                                }else{
                                                    if($jsondata['error'] == 'Insufficient API balance'){
                                                        $this->session->set_flashdata('message', 'Server Not Responding Please Try Again');
                                                    }else{
                                                        $this->session->set_flashdata('message', $jsondata['error']);
                                                    }
                                                }
                                                
                                            }else{
                                                $this->session->set_flashdata('message', 'Api Not Responding Please Try Again');   
                                                // $countxx="0";//fake    
                                            }
                                        // }else{
                                        //     $this->session->set_flashdata('message', 'You KYC is not approved,Please contact Admin');
                                        // }
                                    } else {
                                        $this->session->set_flashdata('message', 'Invalid Master Key');
                                    }
                                } else {
                                    $this->session->set_flashdata('message', 'Insuffcient Balance');
                                }
                            // } else {
                            //     $this->session->set_flashdata('message', 'Withdraw Amount is multiple of 500');
                            // }
                            // } else {
                            //     $this->session->set_flashdata('message', 'Withdraw Two directs required!');
                            // }
                        } else {
                            $this->session->set_flashdata('message', 'Minimum Withdrawal Amount is Rs 200');
                        }
                    }else{
                        $this->session->set_flashdata('message', 'You Can Withdraw Only Once in a Day');
                    }
                    }else{
                        $this->session->set_flashdata('message', 'Please enter correct OTP');
                    }
                    }
                } else {
                    $this->session->set_flashdata('message', 'erorrrrr');
                }
            }
            $response['balance'] = $this->User_model->get_single_record('tbl_income_wallet', ' user_id = "' . $this->session->userdata['user_id'] . '" and type != "recharge_income"', 'ifnull(sum(amount),0) as balance');
            $this->load->view('withdrawAmount', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }


    private function generate_order_id() {
        $order_id = rand(100000000, 999999999);
        $order = $this->User_model->get_single_record('tbl_money_transfer', array('orderid' => $order_id), 'orderid');
        if (!empty($order)) {
            return $this->generate_order_id();
        } else {
            return $order_id;
        }
    }


    // private function curlSetup($paramList){
    //     if(!empty($paramList)){
    //         $apikey= $this->api_token;
    //         $userid= $this->api_user_id;
    //         $headerstring = "$userid|$apikey";
    //         $hashedheaderstring = hash("sha512", $headerstring);
    //     	$paramLists = $paramList;
    //     	$payload = json_encode($paramLists, true);
    //     	$url = "http://13.127.227.22/freeunlimited/v3/transfer.php";
    //     	$header= array('Content-Type:application/json', 'Authorization:'.$hashedheaderstring);
    //     	$ch = curl_init($url);
    //     	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    //     	curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    //     	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);    
    //     	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);  
    //     	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    //     	$response = curl_exec ($ch); 
    //     	$err = curl_error($ch);
    //     	curl_close($ch);
    //     	return json_decode($response, true);
    //     }
    // }

    private function curlSetup($paramList){
        if(!empty($paramList)){
            $apikey= $this->api_token;
            // $userid= $this->api_user_id;
            // $headerstring = "$userid|$apikey";
            // $hashedheaderstring = hash("sha512", $headerstring);
        	$paramLists = $paramList;
        	$payload = json_encode($paramLists, true);
        	$url = "http://13.127.227.22/freeunlimited/v3/transfer.php";
        	$header= array('Content-Type:application/json');
        	$ch = curl_init($url);
        	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        	curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);    
        	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);  
        	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        	$response = curl_exec ($ch); 
        	$err = curl_error($ch);
        	curl_close($ch);
        	return json_decode($response, true);
        }
    }


    public function callBackUrl(){
        //status=SUCCESS&operatortxnid=9001110002&joloorderid=Z123456789012345&userorderid=TEST123456
        $data = array();
        $res = array();
        $data['status'] = $this->input->post('status');
        $data['operatortxnid'] = $this->input->post('operatortxnid');
        $data['joloorderid'] = $this->input->post('joloorderid');
        $data['userorderid'] = $this->input->post('userorderid');
        $res = $this->User_model->update('tbl_money_transfer', array('orderid' => $data['userorderid']), $data);
        if($res){
            if($data['status'] == 'FAILED'){
                $transaction = $this->User_model->get_single_record('tbl_money_transfer', array('orderid' => $data['userorderid']), '*');
                $DirectIncome = array(
                    'user_id' => $transaction['user_id'],
                    'amount' => $transaction['payable_amount'],
                    'type' => 'bank_transfer',
                    'description' => 'Failed Bank Transaction',
                );
                $this->User_model->add('tbl_income_wallet', $DirectIncome);
            }
            $res['status'] = 'SUCCESS';
            $res['message'] = 'Request Updated Successfully';
        }else{
            $res['status'] = 'FAILED';
            $res['message'] = 'Error While Updating Request';
        }
        echo json_encode($res);
    }

}