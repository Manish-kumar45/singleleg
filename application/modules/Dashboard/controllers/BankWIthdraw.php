<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class BankWIthdraw extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('User_model'));
        $this->load->helper(array('user', 'birthdate', 'security', 'email'));
        $this->accessToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjNlZWVhMWIxNzkyMzUxYTIxODEyOWYwYWFiOGQ1MzBlMjhhMmU3N2MxM2U3ZjFjYTY5NDMzMzM0ZDgwMWUwMmVhY2EwNTU4ZDZiN2ZiN2E2In0.eyJhdWQiOiIxIiwianRpIjoiM2VlZWExYjE3OTIzNTFhMjE4MTI5ZjBhYWI4ZDUzMGUyOGEyZTc3YzEzZTdmMWNhNjk0MzMzMzRkODAxZTAyZWFjYTA1NThkNmI3ZmI3YTYiLCJpYXQiOjE1OTYyMTg3NjgsIm5iZiI6MTU5NjIxODc2OCwiZXhwIjoxNjI3NzU0NzY4LCJzdWIiOiIzMTYiLCJzY29wZXMiOltdfQ.AjEt3P6vhcdGa9LkaJNXN1zMr9m3hcMKZw_6D7KWYWd06Nkwxd5Q1A6yjofM9n0Oo9z2_WcbhUa3wlWq2CA-uCSnVS0Mkh0orGLCMSe-4RHozBTbLH8y_8JAWcYO0l9VAb2OzGxJU-P3yQjICvV__JkWqw1Enf72en9XQtXCJzPtxm1O1GLdod4vw483DVbBitpayfqd7sZkgw2GWoyzkguruVNBE33gHDCLMvR7z1IymkzXttPX4X4PuEbFbsDx_ZNL73Yv7ehCDiuBeI69g-P0dPSjawmFtJ7VqzELI68-ik7-QEtliPcIhtFI5cmb9k_KODvpsqL6BmIPjVAjLWoLpXiuiTi3c3Sn1EqHFdFPqvOoEPt7LkMUIMldrNIR6f2CWhaF6-70F-uMhTjM0cxlQYNaYx_91uVY_ObA15MCEwa2vSddhQfJ9dZV4GvFwysm0pQvHbBHqB2YiQNs6ciyFXkyggi9v4290MGmZ9nqYxWXRD1UXmS4cElki00p3-SYoLY4yZiidn0exK7PqpbgLYn4ebDnTXx4lS7gcs0A6kv3lCcfXXsvFLnxJEr-Veo-0QdTD5ehCocqgDY-n1-i00O44PQEjkjPwGkeghTUR-opuOKL6byPl6iUOg13LdR5RqEpyEz7UDulrNpC36R0Zua1KQJ0qWzamyp2EOc';
        // $this->accessToken = '';
        if(!empty($_SESSION["otp_time"])){
            if(time()-$_SESSION["otp_time"] > 120){ 
                unset($_SESSION["otp_time"]);    
            }
        }
    }

    public function index() {
        die('here');
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.pay2all.in/token",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => array('email' => 'ankitmalik905080@gmail.com', 'password' => 'KyamqJ  '),
            CURLOPT_HTTPHEADER => array(
                "Accept: application/json"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

    public function ActivateBanking() {
        if (is_logged_in()) {
            $response = array();
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), 'id,user_id,name,phone,netbanking,email');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('otp', 'OTP', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $parameters = array(
                        'mobile_number' => $response['user']['phone'],
                        'otp' => $this->input->post('otp'),
                    );
                    $key = $this->accessToken;
                    $header = ["Accept:application/json", "Authorization:Bearer " . $key];
                    $method = 'POST';
                    $url = 'https://api.pay2all.in/v1/money/add_sender_confirm';
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                    curl_setopt($ch, CURLOPT_HEADER, false);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
                    curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_URL, $url);
                    $response = curl_exec($ch);
                    $response = json_decode(curl_exec($ch), true);
                    if ($response['status'] == 0) {
                        $this->session->set_flashdata('message', 'This Account Already Activated');
                    } else {
                        $this->session->set_flashdata('message', $response['message']);
                    }
                }
            } else {

                $parameters = array(
                    'mobile_number' => $response['user']['phone']
//                    'mobile_number' => 7710562000
                );
                $key = $this->accessToken;
                $header = ["Accept:application/json", "Authorization:Bearer " . $key];
                $method = 'POST';
                $url = 'https://api.pay2all.in/v1/money/verification';
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($ch, CURLOPT_HEADER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
                curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_URL, $url);
                $response = json_decode(curl_exec($ch), true);
                if ($response['status'] == 0) {
                    $this->session->set_flashdata('message', 'This Account Already Activated');
                } else {
                    $this->session->set_flashdata('message', 'This Account Not Activated');
                }
            }
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), 'id,user_id,name,phone,netbanking,email');
            $this->load->view('activate_banking', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function AddBeneficiary() {
        if (is_logged_in()) {
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), 'id,user_id,name,phone,netbanking,email');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('beneficiary_name', 'Beneficiary Name', 'trim|required|xss_clean');
                $this->form_validation->set_rules('beneficiary_account_no', 'Beneficiary Account Number', 'trim|required|xss_clean');
                $this->form_validation->set_rules('beneficiary_ifsc', 'IFSC Code', 'trim|required|xss_clean');
                $this->form_validation->set_rules('bank_id', 'Bank', 'trim|required|xss_clean');
                // $checkUser = $this->User_model->get_single_record('api_registration',array('user_id' => $this->session->userdata['user_id']),'*');
                // if(empty($checkUser)){
                    $parameters = array(
                        'mobile_number' => $response['user']['phone'],
                        'account_number' => $data['beneficiary_account_no'],
                        'beneficiary_name' => $data['beneficiary_name'],
                        'ifsc' => $data['beneficiary_ifsc'],
                        'bank_id' => $data['bank_id'],
                    );
                    $key = $this->accessToken;
                    $header = ["Accept:application/json", "Authorization:Bearer " . $key];
                    $method = 'POST';
                    $url = 'https://api.pay2all.in/v1/money/add_beneficiary';
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                    curl_setopt($ch, CURLOPT_HEADER, false);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
                    curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_URL, $url);
                    $response2 = curl_exec($ch);
                    $response = json_decode($response2, true);
                    // print_r($response);
                    if ($response['status'] == 0) {
                        $this->session->set_flashdata('message', 'Beneficiary Added Successfully');
                         $userPhone = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), 'user_id,phone');
                        $userData = [
                            'user_id' => $userPhone['user_id'],
                            'phone' => $userPhone['phone'],
                            // 'mobile_number' => $response['user']['phone'],
                            'account_number' => $data['beneficiary_account_no'],
                            'beneficiary_name' => $data['beneficiary_name'],
                            'ifsc' => $data['beneficiary_ifsc'],
                            'bank_id' => $data['bank_id'],
                        ];
                        $this->User_model->add('api_registration',$userData);
                    } else {
                        $this->session->set_flashdata('message', $response['message']);
                    }
                // }else{
                //     $this->session->set_flashdata('message','Your add beneficiary already done');
                // }
            }
            $this->load->view('add_beneficiary', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function BeneficiaryList() {
        if (is_logged_in()) {
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), 'id,user_id,name,phone,netbanking,email');
            $key = $this->accessToken;
            $parameters = array(
                'mobile_number' => $response['user']['phone'],
            );
            $header = ["Accept:application/json", "Authorization:Bearer " . $key];
            $method = 'POST';
            $url = 'https://api.pay2all.in/v1/money/beneficiary';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
            curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL, $url);
            $response2 = curl_exec($ch);
            $response = json_decode(curl_exec($ch), true);
//            pr($response, true);
            $response['beneficiary'] = [];
            if (empty($response['errors'])) {
                if ($response['status'] == 0) {
                    $response['beneficiary'] = $response['data'];
                } else {
                    $this->session->set_flashdata('message', $response['message']);
                }
            }
            $this->load->view('beneficiary_list', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function generate_banking_otp() {
        $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), 'id,user_id,name,phone,netbanking,email');
        $parameters = array(
            'mobile_number' => $response['user']['phone'],
            'first_name' => $response['user']['name'],
            'last_name' => $response['user']['name'],
            'address1' => 'cannaught Place',
            'address2' => 'Abohar',
            'pin_code' => '152116',
        );
        $key = $this->accessToken;
        $header = ["Accept:application/json", "Authorization:Bearer " . $key];
        $method = 'POST';
        $url = 'https://api.pay2all.in/v1/money/add_sender';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $response = curl_exec($ch);
        echo $response;  //[JSON RESPONSE]
    }

    public function user_verfication($phone) {
        $parameters = array(
            'mobile_number' => $phone, //$this->input->post('phone')
        );
        $key = $this->accessToken;
        $header = ["Accept:application/json", "Authorization:Bearer " . $key];
        $method = 'POST';
        $url = 'https://api.pay2all.in/v1/money/verification';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $response = json_decode(curl_exec($ch), true);
        pr($response);  //[JSON RESPONSE]
    }

    public function get_bank_list() {
        $key = $this->accessToken;
        $parameters = array();
        $header = ["Accept:application/json", "Authorization:Bearer " . $key];
        $method = 'GET';
        $url = 'https://api.pay2all.in/v1/money/banks';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $response = curl_exec($ch);
        echo $response;  //[JSON RESPONSE]
    }

    function beneficiary_list() {
        $key = $this->accessToken;
        $parameters = array(
            'mobile_number' => 7497014197, //$this->input->post('mobile_number'),
        );
        $header = ["Accept:application/json", "Authorization:Bearer " . $key];
        $method = 'POST';
        $url = 'https://api.pay2all.in/v1/money/beneficiary';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $response = curl_exec($ch);
        echo $response;  //[JSON RESPONSE]
    }

    public function withdraw_amount($beneficiry_id) {
        if (is_logged_in()) {
            // $this->session->set_flashdata('message', 'We are changing the banking process please wait for some time.');
            // die();
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            $response['beneficiary_id'] = $beneficiry_id;
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('master_key', 'Master Key', 'trim|required|xss_clean');
                // $this->form_validation->set_rules('otp', 'OTP', 'trim|required|xss_clean');
                // $this->session->set_flashdata('message', 'Withdraw is closed');
                // redirect('Dashboard/BankWIthdraw/withdraw_amount/'.$beneficiry_id);
                // exit;
                if ($this->form_validation->run() != FALSE) {
                    // $user_id = $data['user_id'];
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
                    $kyc_status = $this->User_model->get_single_record('tbl_bank_details', array('user_id' => $this->session->userdata['user_id']), '*');
                    $withdraw_amount = $this->input->post('amount');
                    // $winto_user_id = $this->input->post('user_id');
                    $master_key = $this->input->post('master_key');
                    $balance = $this->User_model->get_single_record('tbl_income_wallet', ' user_id = "' . $this->session->userdata['user_id'] . '" && type != "repurchase_income"', 'ifnull(sum(amount),0) as balance');
                    $today_money = $this->User_model->get_single_record('tbl_money_transfer', ' user_id = "' . $this->session->userdata['user_id'] . '" and date(created_at) = date(now())', '*');
                    // if ($user['transaction_flag'] == 0) {
                    //     $this->User_model->update('tbl_users', array('user_id' => $user['user_id']), ['transaction_flag' => 1]);

                        // if (empty($today_money)) {
                            if ($withdraw_amount >= 200 && $withdraw_amount <= 5000) {
                                if ($withdraw_amount % 200 == 0) {
                                    if ($balance['balance'] >= $withdraw_amount) {
                                        if ($user['master_key'] == $master_key) {
                                            // if($data['otp'] == $_SESSION['otp']){
                                                // if(!empty($_SESSION["otp_time"])){
                                                    $transfer_amount = (round($data['amount'])); // 10% IMPS charges including admin+tds
                                                    $myorderid = $this->generate_order_id();

                                                    $key = $this->accessToken;
                                                    $parameters = array(
                                                        'mobile_number' => $response['user']['phone'],
                                                        'amount' => $withdraw_amount,
                                                        'beneficiary_id' => $beneficiry_id,
                                                        'channel_id' => 2,
                                                        'client_id' => $myorderid,
                                                        'provider_id' => 39,
                                                    );
                                                    $header = ["Accept:application/json", "Authorization:Bearer " . $key];
                                                    $method = 'POST';
                                                    $url = 'https://api.pay2all.in/v1/money/transfer';
        //                                            $url = 'https://api.pay2all.in/v1/payout/transfer';
                                                    $ch = curl_init();
                                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                                                    curl_setopt($ch, CURLOPT_HEADER, false);
                                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                                    curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
                                                    curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
                                                    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                                                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
                                                    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
                                                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                                    curl_setopt($ch, CURLOPT_URL, $url);
                                                    $r = curl_exec($ch);
                                                    // echo $response;  //[JSON RESPONSE]
                                                    $res = json_decode($r, true);
        //                                             pr($res);
                                                    if ($res['status'] == 0 || $res['status'] == 1 || $res['status'] == 3) {
                                                        $DirectIncome = array(
                                                            'user_id' => $this->session->userdata['user_id'],
                                                            'amount' => - $withdraw_amount,
                                                            'type' => 'bank_transfer',
                                                            'description' => 'Bank Transfer',
                                                        );
                                                        $this->User_model->add('tbl_income_wallet', $DirectIncome);
                                                        if(empty($res['status'])){
                                                            $res['status'] = 0;
                                                        }
                                                        $transactionArr = array(
                                                            'user_id' => $this->session->userdata['user_id'],
                                                            'beneficiaryid' => $beneficiry_id,
                                                            'amount' => $transfer_amount,
                                                            'status' => $res['status'],
                                                            'orderid' => $myorderid,
                                                            'payable_amount' => $withdraw_amount,
                                                            'operatortxnid' => $res['utr'],
                                                        );
                                                        // pr($transactionArr);
                                                        $this->User_model->add('tbl_money_transfer', $transactionArr);
                                                        $this->session->set_flashdata('message', 'Transaction Completed Successfully');
                                                    } else {
                                                        $this->session->set_flashdata('message', $res['message']);
                                                    }
                                                // } else {
                                                //     $this->session->set_flashdata('message', 'OTP is expired');
                                                // }
                                            // } else {
                                            //     $this->session->set_flashdata('message', 'Please enter correct OTP');
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
                        // } else {
                        //     $this->session->set_flashdata('message', 'You Can Withdraw Only Once in a Day');
                        // }
                    //     $this->User_model->update('tbl_users', array('user_id' => $user['user_id']), ['transaction_flag' => 0]);
                    // } else {
                    //     $this->session->set_flashdata('message', 'Your Another Transaction is in Process Please Wait for 5 Minutes');
                    // }
                } else {
                    $this->session->set_flashdata('message', 'erorrrrr');
                }
            }
            $response['balance'] = $this->User_model->get_single_record('tbl_income_wallet', ' user_id = "' . $this->session->userdata['user_id'] . '" && type != "repurchase_income"', 'ifnull(sum(amount),0) as balance');
            $this->load->view('pay2all_send_money_bank', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function pay2all_payment(){
        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => 'HK31334'), '*');
        $myorderid = $this->generate_order_id();
        $key = $this->accessToken;
        $beneficiry_id = 181296;
        $withdraw_amount = 1400;
        $parameters = array(
            'mobile_number' => $user['phone'],
            'amount' => $withdraw_amount,
            'beneficiary_id' => $beneficiry_id,
            'channel_id' => 2,
            'client_id' => $myorderid,
            'provider_id' => 39,
        );
        $header = ["Accept:application/json", "Authorization:Bearer " . $key];
        $method = 'POST';
        $url = 'https://api.pay2all.in/v1/money/transfer';
//                                            $url = 'https://api.pay2all.in/v1/payout/transfer';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $r = curl_exec($ch);
        // echo $response;  //[JSON RESPONSE]
        $res = json_decode($r, true);
        if ($res['status'] == 0 || $res['status'] == 1 || $res['status'] == 3) {
            $DirectIncome = array(
                'user_id' => $user['user_id'],
                'amount' => - $withdraw_amount,
                'type' => 'bank_transfer',
                'description' => 'Bank Transfer',
            );
            $this->User_model->add('tbl_income_wallet', $DirectIncome);
            if(empty($res['status'])){
                $res['status'] = 0;
            }
            $transactionArr = array(
                'user_id' => $user['user_id'],
                'beneficiaryid' => $beneficiry_id,
                'amount' => 5000,
                'status' => $res['status'],
                'orderid' => $myorderid,
                'payable_amount' => $withdraw_amount,
                'operatortxnid' => $res['utr'],
            );
            // pr($transactionArr);
            $this->User_model->add('tbl_money_transfer', $transactionArr);
            echo 'Transaction Completed Successfully';
        } else {
            echo $res['message'];
        }
        // redirect('Dashboard/BankWIthdraw/pay2all_payment');
    }
    public function generate_order_id() {
        $order_id = rand(10000, 99999);
        $order = $this->User_model->get_single_record('tbl_money_transfer', array('orderid' => $order_id), 'orderid');
        if (!empty($order)) {
            return $this->generate_order_id();
        } else {
            return $order_id;
        }
    }


    public function pay2all_callback_url(){
        $data = $this->input->post('status_id');
        $this->User_model->add('test_callback', 'post_data', $data);
    }

    public function pay2allCheckStatus(){
        // die();
        $get = $this->User_model->get_records('tbl_money_transfer', 'operatortxnid = "" AND status = "1"', 'orderid,user_id,payable_amount');
        if(!empty($get)){
            foreach ($get as $key => $value) {
                $data = $this->curlCheckStatus($value['orderid']);
                if($data['status'] > 0 && !empty($data)){
                //pr($data);
                    $utr = $data['utr'];
                    if($data['status_id'] == 1){
                        $this->User_model->update('tbl_money_transfer', array('orderid' => $data['client_id']), ['status' => 1, 'operatortxnid' => $utr]);
                    }elseif($data['status_id'] == 2){
                        $DirectIncome = array(
                            'user_id' => $value['user_id'],
                            'amount' => $value['payable_amount'],
                            'type' => 'bank_transfer',
                            'description' => 'Failed Bank Transaction',
                        );
                        $this->User_model->add('tbl_income_wallet', $DirectIncome);
                        $this->User_model->update('tbl_money_transfer', array('orderid' => $data['client_id']), ['status' => 2, 'operatortxnid' => $utr]);

                    }elseif($data['status_id'] == 3){
                        $this->User_model->update('tbl_money_transfer', array('orderid' => $data['client_id']), ['status' => 3, 'operatortxnid' => $utr]);
                    }elseif($data['status_id'] == 4){
                        $this->User_model->update('tbl_money_transfer', array('orderid' => $data['client_id']), ['status' => 4, 'operatortxnid' => $utr]);
                        $DirectIncome2 = array(
                            'user_id' => $value['user_id'],
                            'amount' => $value['payable_amount'],
                            'type' => 'bank_transfer',
                            'description' => 'Failed Bank Transaction and Refund',
                        );
                        $this->User_model->add('tbl_income_wallet', $DirectIncome2);
                    }
                    //echo 'Done.';
                }else{
                    echo 'Too Many Attempts.';
                }
            }
        }else{
            echo 'Noo more users.';
        }
        
    }

    public function curlCheckStatus($client_id){
        $key = $this->accessToken;
        $parameters = array(
            'client_id' =>  $client_id,
        );
        $header = ["Accept:application/json", "Authorization:Bearer " . $key];
        $method = 'POST';
        $url = 'https://api.pay2all.in/v1/payment/status';
//                                            $url = 'https://api.pay2all.in/v1/payout/transfer';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $r = curl_exec($ch);
        // echo $response;  //[JSON RESPONSE]
        $res = json_decode($r, true);
        pr($res);
        return($res);
    }

}
