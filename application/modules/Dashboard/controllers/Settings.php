<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('Shopping_model' , 'User_model'));
        $this->load->helper(array('user', 'birthdate', 'security', 'email'));
    }

    public function index() {
        if (is_logged_in()) {
            $response['products'] = $this->Shopping_model->get_product();
            $this->load->view('Shopping/products', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function epins($status) {
        if (is_logged_in()) {
            if ($status < 3) {
                $where = array('user_id' => $this->session->userdata['user_id'], 'status' => $status);
            } else {
                $where = array('user_id' => $this->session->userdata['user_id']);
            }
            $response['records'] = $this->Shopping_model->get_records('tbl_epins', $where, '*');
            $response['header'] = 
            $this->load->view('epins_list', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function transfer_epins() {
        if (is_logged_in()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('epins', 'Epins', 'trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('user_id', 'User ID', 'trim|xss_clean');
                $this->form_validation->set_rules('master_key', 'Master Key', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $data['user_id']), 'user_id,phone');
                    $master_key = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), 'user_id,phone,master_key');
                    if ($master_key['master_key'] == $data['master_key']) {
                        if (!empty($user)) {
                            $available_pins = $this->User_model->get_single_record('tbl_epins', array('user_id' => $this->session->userdata['user_id'], 'status' => 0), 'ifnull(count(id),0) as total_epins');
                            if ($data['epins'] > 0) {
                                if ($data['epins'] <= $available_pins['total_epins']) {
                                    for ($i = 1; $i <= $data['epins']; $i++) {
                                        $pin = $this->User_model->get_single_record('tbl_epins', array('user_id' => $this->session->userdata['user_id'], 'status' => 0), '*');
                                        $this->User_model->update('tbl_epins', array('id' => $pin['id']), array('status' => 2, 'used_for' => $data['user_id']));
                                        $packArr = array(
                                            'user_id' => $data['user_id'],
                                            'epin' => $this->generate_pin(),
                                            'amount' => $pin['amount'],
                                            'sender_id' => $this->session->userdata['user_id']
                                        );
                                        $res = $this->User_model->add('tbl_epins', $packArr);
                                        $this->session->set_flashdata('message', 'Pin Transferred Successfully');
                                    }
                                }else{
                                    $this->session->set_flashdata('message', 'Insufficient Pin Balance');
                                }
                            } else {
                                $this->session->set_flashdata('message', 'Please Set Atleast 1 Pin');
                            }
                        } else {
                            $this->session->set_flashdata('message', 'Invalid User ID');
                        }
                    } else {
                        $this->session->set_flashdata('message', 'Invalid Master Key');
                    }
                }
            }
            $response['available_epins'] = $this->User_model->get_single_record('tbl_epins', array('user_id' => $this->session->userdata['user_id'], 'status' => 0), 'ifnull(count(id),0) as total_epins');
            $this->load->view('transfer_epin', $response);
        } else {
            redirect('Dashboard/User/login');
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

    
}
