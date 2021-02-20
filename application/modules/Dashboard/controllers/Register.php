<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('Register_model'));
        $this->load->helper(array('user', 'birthdate', 'security', 'email'));
    }


    public function Register() {
        $response = array();
        $sponser_id = $this->input->get('sponser_id');
        if ($sponser_id == '') {
            $sponser_id = '';
        }
        $response['sponser_id'] = $sponser_id;
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            //echo 'there';
            $this->form_validation->set_rules('sponser_id', 'Sponser ID', 'trim|required|xss_clean');
            $this->form_validation->set_rules('phone', 'Phone', 'trim|required|numeric|xss_clean');
            $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', validation_errors());
                $this->load->view('register', $response);
            } else {
                $sponser_id = $this->input->post('sponser_id');
                $response['sponser_id'] = $sponser_id;
                $sponser = $this->Register_model->get_single_record('tbl_users', array('user_id' => $sponser_id), 'user_id,paid_status');
                if (!empty($sponser)) {
                    $free_sponser = $this->Register_model->get_single_record('tbl_users' , array('sponser_id' => $sponser_id , 'paid_status' => 0) ,'ifnull(count(id),0) as free_direct');
                    if($free_sponser['free_direct'] < 5000000){
                        if ($sponser['paid_status'] == 1) {
                            $user_id = $this->getUserIdForRegister();
                            $userData['user_id'] = $user_id; //'AMAZING'.$id_number;
                            $userData['sponser_id'] = $sponser_id;
                            $userData['name'] = $this->input->post('name');
                            $userData['phone'] = $this->input->post('phone');
                            $userData['password'] = rand(1000, 9999);
                            $userData['master_key'] = rand(1000, 9999);
                            $res = $this->Register_model->add('tbl_users', $userData);
                            $bankDetails['user_id'] = $userData['user_id'];
                            $res = $this->Register_model->add('tbl_bank_details', $bankDetails);
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
            $this->load->view('register2', $response);
        }
    }

    public function getUserIdForRegister() {
        $user_id = 'HK' . rand(100000, 999999);
        $sponser = $this->Register_model->get_single_record('tbl_users', array('user_id' => $user_id), 'user_id,name');
        if (!empty($sponser)) {
            return $this->getUserIdForRegister();
        } else {
            return $user_id;
        }
    }
    function add_counts($user_name = 'DW56497', $downline_id = 'DW56497', $level) {
        $user = $this->Register_model->get_single_record('tbl_users', array('user_id' => $user_name), $select = 'sponser_id,user_id');
        if ($user['sponser_id'] != '') {
            $downlineArray = array(
                'user_id' => $user['sponser_id'],
                'downline_id' => $downline_id,
                'position' => '',
                'created_at' => 'CURRENT_TIMESTAMP',
                'level' => $level,
            );
            $this->Register_model->add('tbl_downline_count', $downlineArray);
            $user_name = $user['sponser_id'];
            $this->add_counts($user_name, $downline_id, $level + 1);
        }
    }

}