<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AjaxController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('User_model'));
        $this->load->helper(array('user', 'birthdate', 'security', 'email'));
    }

    public function get_refferal_code() {
        if (is_logged_in()) {
            $response = array();
            $refferal_code = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), 'refferal_count');
            echo base_url('Dashboard/User/Step1/?sponser_id=' . $this->session->userdata['user_id'] . '-DWAY' . $refferal_code['refferal_count']);
            $this->User_model->update('tbl_users', array('user_id' => $this->session->userdata['user_id']), array('refferal_count' => $refferal_code['refferal_count'] + 1));
        } else {
            redirect('Dashboard/User/login');
        }
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

    public function Generate_otp() {
        if (is_logged_in()) {
            $response = array();
            $otp = rand(1000, 9999);
            $response['otp'] = $otp;
            $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), 'user_id,first_name,last_name,email');
            $message = "Dear " . $user['first_name'] . ' ' . $user['last_name'] . ' One time password for Your Withdraw request is ' . $otp;
            $response['message'] = 'One Time Password Sent on Your Email Please check';
            $this->send_email($user['email'], 'Security Alert', $message);
            $this->User_model->update('tbl_users', array('user_id' => $this->session->userdata['user_id']), array('otp' => $otp));
            echo json_encode($response);
            exit();
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function royalty_achievrs() {
        if (is_logged_in()) {
            $response = array();
            $i = 0;
            $response['royalty_achievers'] = [];
            // $royalty_achievers = $this->User_model->royalty_achievers();
            response['royalty_achievers'] = $this->User_model->get_records('tbl_users',array('directs >=' => '50'),'id,user_id,name');
            // foreach($royalty_achievers as $key => $achiever){
            //     $levelDirect = $this->User_model->get_single_record('tbl_users',array('sponser_id' => $achiever['user_id'],'directs >=' => '5'),'count(id) as record');
            //     if($levelDirect['record'] >= '5'){
            //         $response['royalty_achievers'][$i] = $achiever;
            //     }
            //     $i++;
            // }
            echo json_encode($response);
            exit();
        } else {
            redirect('Dashboard/User/login');
        }
    }

}
