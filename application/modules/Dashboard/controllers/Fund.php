<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Fund extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('User_model'));
        $this->load->helper(array('user', 'security'));
    }

    public function Request_fund() {
        if (is_logged_in()) {
            $response = array();
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->set_userdata['user_id']), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['file_name'] = 'payment_slip';
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('userfile')) {
                    $this->session->set_flashdata('message', $this->upload->display_errors());
                } else {
                    $fileData = array('upload_data' => $this->upload->data());
                    $reqArr = array(
                        'user_id' => $this->session->userdata['user_id'],
                        'amount' => $data['amount'],
                        'payment_method' => $data['payment_method'],
                        'image' => $fileData['upload_data']['file_name'],
                        'status' => 0,
                    );
                    $res = $this->User_model->add('tbl_payment_request', $reqArr);
                    if ($res) {
                        $this->session->set_flashdata('message', 'Payment Request Submitted Successfully');
                    } else {
                        $this->session->set_flashdata('message', 'Error While Submitting Payment Request Please Try Again ...');
                    }
                }
            }
            $this->load->view('header', $response);
            $this->load->view('Fund/request_fund', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function requests() {
        if (is_logged_in()) {
            $response = array();
            $response['requests'] = $this->User_model->get_records('tbl_payment_request', array('user_id' => $this->session->userdata['user_id']), '*');
            $this->load->view('requests', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function transfer_history() {
        if (is_logged_in()) {
            $response = array();
            $response['records'] = $this->User_model->get_records('tbl_wallet', array('user_id' => $this->session->userdata['user_id'], 'type' => 'fund_transfer'), '*');
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
            $this->load->view('header', $response);
            $this->load->view('Fund/transfer_history', $response);
            $this->load->view('footer');
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function wallet_ledger() {
        if (is_logged_in()) {
            $response = array();
            $response['records'] = $this->User_model->get_records('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), '*');
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
            $this->load->view('header');
            $this->load->view('wallet_ledger', $response);
            $this->load->view('footer');
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function transfer_fund() {
        if (is_logged_in()) {
            date_default_timezone_set('Asia/Kolkata');
            $response = array();
            $response['show_otp'] = 0;
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), 'id,user_id,name,master_key,otp,otp_time');
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|xss_clean');
                // $this->form_validation->set_rules('master_key', 'Txn. Password', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    // if ($response['user']['master_key'] == $data['master_key']) {
                        if ($data['amount'] > 0) {
                            if ($data['user_id'] != $this->session->set_userdata['user_id']) {
                                $receiver = $this->User_model->get_single_record('tbl_users', array('user_id' => $data['user_id']), '*');
                                if (!empty($receiver)) {
                                    if ($response['wallet_amount']['wallet_amount'] >= $data['amount']) {
                                        $senderData = array(
                                            'user_id' => $this->session->userdata['user_id'],
                                            'amount' => -$data['amount'],
                                            'sender_id' => $data['user_id'],
                                            'type' => 'fund_transfer',
                                            'remark' => $data['remark'],
                                        );
                                        $res = $this->User_model->add('tbl_wallet', $senderData);
                                        if ($res) {
                                            $response['wallet_amount']['wallet_amount'] = $response['wallet_amount']['wallet_amount'] - $data['amount'];
                                            $this->session->set_flashdata('message', 'Fund Transferred Successfully');
                                            $receiverData = array(
                                                'user_id' => $data['user_id'],
                                                'amount' => $data['amount'],
                                                'sender_id' => $this->session->userdata['user_id'],
                                                'type' => 'fund_transfer',
                                                'remark' => $data['remark'],
                                            );
                                            $this->User_model->add('tbl_wallet', $receiverData);
                                        } else {
                                            $this->session->set_flashdata('message', 'Error While Transferring Fund Please Try Again ...');
                                        }

                                        // if($data['otp'] == ''){
                                        //     $otpData = array(
                                        //         'otp' => rand(1000,9999),
                                        //         'otp_time' => date('Y-m-d H:i:s')
                                        //     );
                                        //     $this->User_model->update('tbl_users', array('user_id' =>  $this->session->userdata['user_id']), $otpData);
                                        //     $response['show_otp'] = 1;
                                        //     $response['otp_time'] = $otpData['otp_time'];
                                        //     $message = "Dear " .  $response['user']['name'] . ' One Time Password for Fund Transfer is '. $otpData['otp'] .' ' . base_url();
                                        //     notify_user($response['user']['user_id'], $message);
                                        // }else{
                                        //     if($data['otp'] == $response['user']['otp']){
                                        //         if(date('Y-m-d H:i:s') < date('Y-m-d H:i:s', strtotime('+3 minute', strtotime($response['user']['otp_time'])))){
                                                    
                                        //         }else{
                                        //             $this->session->set_flashdata('message', 'One Time Password Expired');
                                        //         }
                                        //     }else{
                                        //         $response['show_otp'] = 1;
                                        //         $response['otp_time'] = $response['user']['otp_time'];
                                        //         $this->session->set_flashdata('message', 'Invalid Otp');
                                        //     }

                                        // }
                                    } else {
                                        $this->session->set_flashdata('message', 'Maximum Transfer Amount is ' . $response['wallet_amount']['wallet_amount']);
                                    }
                                } else {
                                    $this->session->set_flashdata('message', 'Invalid Receiver Id');
                                }
                            } else {
                                $this->session->set_flashdata('message', 'You Cannot Transfer Amount In Same Account');
                            }
                        } else {
                            $this->session->set_flashdata('message', 'Minimun Transfer Amount is rs 0');
                        }
                    // } else {
                    //     $this->session->set_flashdata('message', 'Incorrect Transaction Password');
                    // }
                }
            }
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
            $this->load->view('header', $response);
            $this->load->view('Fund/transfer_fund', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function otp_fund_transfer(){

    }

    public function all_transactions() {
        if (is_logged_in()) {
            $response = array();
            $response['transactions'] = $this->User_model->get_records('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id']), 'id,user_id,amount,type,description,created_at');
            $this->load->view('all_transactions', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function withdraw_request() {
        if (is_logged_in()) {
            $response = array();
            $response['balance'] = $this->User_model->get_single_record('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as total_income');
//            pr($response,true);
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                if ($data['amount'] > 0) {
                    if ($response['balance']['total_income'] >= $data['amount']) {
                        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), 'otp');
                        if ($user['otp'] == $data['otp']) {

                            $incomeArr = array(
                                'user_id' => $this->session->userdata['user_id'],
                                'amount' => -$data['amount'],
                                'type' => 'withdraw_amount',
                                'description' => 'WIthdraw Amount',
                            );
                            $withdrawArr = array(
                                'user_id' => $this->session->userdata['user_id'],
                                'amount' => $data['amount'],
                            );
                            $res = $this->User_model->add('tbl_income_wallet', $incomeArr);
                            $this->User_model->add('tbl_withdraw', $withdrawArr);
                            if ($res) {
                                $this->session->set_flashdata('message', 'Withdraw Request Submitted Successfully');
                                $response['balance'] = $this->User_model->get_single_record('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as total_income');
                            } else {
                                $this->session->set_flashdata('message', 'Error While Requesting Withdraw Please Try Again ...');
                            }
                        } else {
                            $this->session->set_flashdata('message', 'Invalid Otp');
                        }
                    } else {
                        $this->session->set_flashdata('message', 'Maximum Transfer Amount is $' . $response['balance']['total_income']);
                    }
                } else {
                    $this->session->set_flashdata('message', 'Minimun Withdraw Amount is $0');
                }
            }
            $this->load->view('withdraw_request', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function withdraw_summary() {
        if (is_logged_in()) {
            $response = array();
            $response['withdraw_transctions'] = $this->User_model->get_records('tbl_withdraw', array('user_id' => $this->session->userdata['user_id']), '*');
            $response['balance'] = $this->User_model->get_single_record('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as sum');
//            $this->load->view('header', $response);
            $this->load->view('withdraw_summary', $response);
//            $this->load->view('footer');
        } else {
            redirect('Dashboard/User/login');
        }
    }

}
