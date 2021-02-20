<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('Main_model'));
        $this->load->helper(array('admin', 'security'));
    }

    public function index() {
        if (is_admin()) {
            $response['packages'] = $this->Main_model->get_records('tbl_package', array(), '*');
            $this->load->view('package_list', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function news() {
        if (is_admin()) {
            $response['news'] = $this->Main_model->get_records('tbl_news', array(), '*');
            $this->load->view('news', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function newsDelete($id){
        if (is_admin()) {
            $res = $this->Main_model->delete('tbl_news', $id);
            $this->session->set_flashdata('message', 'News Deleted Successfully');
            redirect('Admin/Settings/News');
        } else {
            redirect('Admin/Management/login');
        }
    }


    public function sendIncome() {
        if (is_admin()) {
        $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('otp', 'otp', 'trim|required|xss_clean');
                $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|xss_clean');
                $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric|numeric|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    if($data['amount'] <= 5000){
                        if($this->session->otp == $data['otp'] && !empty($this->session->otp)){
                            $user_id = $data['user_id'];
                            $user = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                            $info = $this->Main_model->get_single_record('tbl_income_wallet', 'user_id = "'.$user_id.'" AND date(created_at) = date(NOW()) AND description = "Income Refunded by Admin"', 'count(id) as ids');
                            if($info['ids'] == 0){
                                if (!empty($user)) {
                                    $sendWallet = array(
                                        'user_id' => $user_id,
                                        'amount' => $data['amount'],
                                        'type' => 'bank_transfer',
                                        'description' => 'Income Refunded by Admin',
                                    );
                                    $this->Main_model->add('tbl_income_wallet', $sendWallet);
                                    $this->session->set_flashdata('message', 'Income Return Successfully');
                                } else {
                                    $this->session->set_flashdata('message', 'Invalid User ID');
                                }
                            }else{
                                $this->session->set_flashdata('message', 'You already send income to this user please try tommorrow');
                            }
                                
                        }else{
                            $this->session->set_flashdata('message', 'Invalid OTP');
                        }
                            
                    }else{
                            $this->session->set_flashdata('message', 'Invalid Amount Entered');
                    }
                }
            }
            $this->load->view('send_income', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }


    public function sendIncomeHistory() {
        if (is_admin()) {
            $response['tasks'] = $this->Main_model->get_records('tbl_income_wallet', 'description = "Income Refunded by Admin"', '*');
            $this->load->view('sendIncomeHistory', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function payout_summary() {
        if (is_admin()) {
            $config['total_rows'] = $this->Main_model->payout_dates_count();
            $config['base_url'] = base_url('Admin/Settings/payout_summary/');
            $config ['uri_segment'] = 4;
            $config['per_page'] = 10;
            $config['attributes'] = array('class' => 'page-link');
            $config['full_tag_open'] = "<ul class='pagination'>";
            $config['full_tag_close'] = '</ul>';
            $config['num_tag_open'] = '<li class="paginate_button page-item ">';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="paginate_button page-item  active"><a href="#" class="page-link">';
            $config['cur_tag_close'] = '</a></li>';
            $config['prev_tag_open'] = '<li class="paginate_button page-item ">';
            $config['prev_tag_close'] = '</li>';
            $config['first_tag_open'] = '<li class="paginate_button page-item">';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li class="paginate_button page-item next">';
            $config['last_tag_close'] = '</li>';
            $config['prev_link'] = 'Previous';
            $config['prev_tag_open'] = '<li class="paginate_button page-item previous">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = 'Next';
            $config['next_tag_open'] = '<li  class="paginate_button page-item next">';
            $config['next_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $segment = $this->uri->segment(4);
            $response['records'] = $this->Main_model->datewise_payout($config['per_page'], $segment);
            foreach($response['records'] as $key => $record){
                $incomes = $this->Main_model->get_incomes('tbl_income_wallet', array('date(created_at)' => $record['date'],'amount > ' => 0), 'ifnull(sum(amount),0) as income , type');
               $response['records'][$key]['incomes'] = calculate_incomes($incomes);
            }
            $response['headerMenu'] = $this->Main_model->getIncomeType();
            $response['segament'] = $segment;
            $response['total_records'] = $config['total_rows'];
            // pr($response,true);
            $this->load->view('payout_summary', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function date_payout($date = '') {
        if (is_admin()) {
            $response['header'] = 'Date Payout';
            $config['base_url'] = base_url() . 'Admin/Settings/date_payout/' . $date;
            $config['total_rows'] = $this->Main_model->get_sum('tbl_income_wallet', array('date(created_at)' => $date), 'ifnull(count(id),0) as sum');
            $config['per_page'] = 50;
            $config['attributes'] = array('class' => 'page-link');
            $config['full_tag_open'] = "<ul class='pagination'>";
            $config['full_tag_close'] = '</ul>';
            $config['num_tag_open'] = '<li class="paginate_button page-item ">';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="paginate_button page-item  active"><a href="#" class="page-link">';
            $config['cur_tag_close'] = '</a></li>';
            $config['prev_tag_open'] = '<li class="paginate_button page-item ">';
            $config['prev_tag_close'] = '</li>';
            $config['first_tag_open'] = '<li class="paginate_button page-item">';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li class="paginate_button page-item next">';
            $config['last_tag_close'] = '</li>';
            $config['prev_link'] = 'Previous';
            $config['prev_tag_open'] = '<li class="paginate_button page-item previous">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = 'Next';
            $config['next_tag_open'] = '<li  class="paginate_button page-item next">';
            $config['next_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $segment = $this->uri->segment(5);
            $response['total_income'] = $this->Main_model->get_sum('tbl_income_wallet', array('date(created_at)' => $date), 'ifnull(sum(amount),0) as sum');
            $response['user_incomes'] = $this->Main_model->get_limit_records('tbl_income_wallet', array('date(created_at)' => $date), '*', $config['per_page'], $segment, true);
            $response['segament'] = $segment;
            $this->load->view('incomes', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }


    public function EditUser($user_id) {
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                if($data['form_type'] == 'personal'){
                    $this->form_validation->set_rules('otp', 'otp', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('phone', 'Phone', 'trim|numeric|required|xss_clean');
                    if ($this->form_validation->run() != FALSE) {
                        if($this->session->otp == $data['otp'] && !empty($this->session->otp)){
                            $UserData = array(
                                'name' => $data['name'],
                                'email' => $data['email'],
                                'phone' => $data['phone'],
                            );
                            $res = $this->Main_model->update('tbl_users', array('user_id' => $user_id),$UserData);
                            if ($res == TRUE) {
                                $this->session->set_flashdata('message', 'User Details Updated Successfully');
                            } else {
                                $this->session->set_flashdata('message', 'Error While Updating Details Please Try Again ...');
                            }
                        }else{
                            $this->session->set_flashdata('message', 'ERROR:: OTP not matched!');
                        }
                    }
                }elseif($data['form_type'] == 'password'){
                    $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
                    if ($this->form_validation->run() != FALSE) {
                        $UserData = array(
                            'password' => $data['password']
                        );
                        $res = $this->Main_model->update('tbl_users', array('user_id' => $user_id),$UserData);
                        if ($res == TRUE) {
                            $this->session->set_flashdata('message', 'Password Updated Successfully');
                        } else {
                            $this->session->set_flashdata('message', 'Error While Password Please Try Again ...');
                        }
                    }
                }elseif($data['form_type'] == 'master_key'){
                    $this->form_validation->set_rules('master_key', 'Transaction Password', 'trim|required|xss_clean');
                    if ($this->form_validation->run() != FALSE) {
                        $UserData = array(
                            'master_key' => $data['master_key']
                        );
                        $res = $this->Main_model->update('tbl_users', array('user_id' => $user_id),$UserData);
                        if ($res == TRUE) {
                            $this->session->set_flashdata('message', 'Transaction Password Updated Successfully');
                        } else {
                            $this->session->set_flashdata('message', 'Error While Transaction Password Please Try Again ...');
                        }
                    }
                }elseif($data['form_type'] == 'sponser_change'){
                    $this->form_validation->set_rules('sponser_id', 'Sponser ID', 'trim|required|xss_clean');
                    if ($this->form_validation->run() != FALSE) {
                         $this->session->set_flashdata('message', 'This Service is not available');    
                        // $UserData = array(
                        //     'sponser_id' => $data['sponser_id']
                        // );
                        // $sponser = $this->Main_model->get_single_record('tbl_users', array('user_id' => $data['sponser_id']), 'user_id');
                        // if(!empty($sponser)){
                        //     $res = $this->Main_model->update('tbl_users', array('user_id' => $user_id),$UserData);
                        //     if ($res == TRUE) {
                        //         $this->session->set_flashdata('message', 'Sponser Updated Successfully');
                        //     } else {
                        //         $this->session->set_flashdata('message', 'Error While Transaction Password Please Try Again ...');
                        //     }                            
                        // }else{
                        //     $this->session->set_flashdata('message', 'Invalid Sponser ID');                            
                        // }
                    }
                }elseif($data['form_type'] == 'paid_status'){
                    $this->form_validation->set_rules('paid_status', 'Paid Status', 'trim|required|xss_clean');
                    if ($this->form_validation->run() != FALSE) {
                         $this->session->set_flashdata('message', 'This Service is not available');    
                    //     $UserData = array(
                    //         'paid_status' => $data['paid_status'],
                    //         'package_amount' => 700
                    //     );
                    //     $res = $this->Main_model->update('tbl_users', array('user_id' => $user_id),$UserData);
                    //     if ($res == TRUE) {
                    //         $this->session->set_flashdata('message', 'User Activated Successfully');
                    //     } else {
                    //         $this->session->set_flashdata('message', 'Error While Updating Activating User Please Try Again ...');
                    //     }   
                     }
                }
                else{
                    $this->form_validation->set_rules('account_holder_name', 'Account Holder Name', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('bank_name', 'Bank Name', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('bank_account_number', 'Bank Account Number', 'trim|numeric|required|xss_clean');
                    $this->form_validation->set_rules('ifsc_code', 'IFSC Code', 'trim|required|xss_clean');
                    if ($this->form_validation->run() != FALSE) {
                        $UserData = array(
                            'account_holder_name' => $data['account_holder_name'],
                            'bank_name' => $data['bank_name'],
                            'bank_account_number' => $data['bank_account_number'],
                            'ifsc_code' => $data['ifsc_code'],
                        );
                        $res = $this->Main_model->update('tbl_bank_details', array('user_id' => $user_id),$UserData);
                        if ($res == TRUE) {
                            $this->session->set_flashdata('message', 'BANK Details Updated Successfully');
                        } else {
                            $this->session->set_flashdata('message', 'Error While Updating Bank Details Please Try Again ...');
                        }
                    }
                }
            }
            $response['user'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
            $response['user']['bank'] = $this->Main_model->get_single_record('tbl_bank_details', array('user_id' => $user_id), '*');
            $this->load->view('edit_user', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function roi_setup($user_id){
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('amount', 'Amount', 'trim|numeric|required|xss_clean');
                $this->form_validation->set_rules('days', 'Days', 'trim|numeric|required|xss_clean');
                $this->form_validation->set_rules('level', 'Level', 'trim|numeric|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $roi_status =  $this->Main_model->get_single_record('tbl_roi', array('level' => $data['level'],'user_id' => $user_id), '*');
                    if(empty($roi_status)){
                        $UserData = array(
                            'user_id' => $user_id,
                            'amount' => $data['amount'],
                            'level' => $data['level'],
                            'days' => $data['days'],
                            'type' => 'single_leg',
                            'remark' => 'Single Leg Income for '.$data['level'].' Level',
                            'status' => '1',
                        );
                        $res = $this->Main_model->add('tbl_roi',$UserData);
                        if ($res == TRUE) {
                            $this->session->set_flashdata('message', 'Roi Started Successfully');
                        } else {
                            $this->session->set_flashdata('message', 'Error While Starting Roi Please Try Again ...');
                        }
                    }else{
                        $this->session->set_flashdata('message', 'This Roi Already Created');
                    }
                }else{
                    $this->session->set_flashdata('message', validation_errors);
                }
            }
            $response['user'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
            $response['rois'] = $this->Main_model->get_records('tbl_roi', array('user_id' => $user_id), '*');
            $this->load->view('roi_list', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }


    public function adminEditProfileOtp($beneficiry_id){
        if (is_admin()) {
            $_SESSION['otp'] = rand(100000, 999999);
            $this->session->mark_as_temp('otp', 120);
            if(!empty($_SESSION['otp'])){
                $message = 'Your OTP is '.$_SESSION['otp'].' Please never share your OTP (One Time Password) with anyone, This OTP is valid for 2 Mintues.';
                notify_user($message);
                $this->session->set_flashdata('message', 'OTP send on your registered mobile no.');
            }else{
                 $this->session->set_flashdata('message', 'ERROR:: OTP Failed!  ');
            }
            redirect('Admin/Settings/EditUser/'.$beneficiry_id.'');
        }else{
            redirect('Dashboard/User/login');
        }
    }

        public function sendIncomeOtp(){
        if (is_admin()) {
            $_SESSION['otp'] = rand(100000, 999999);
            $this->session->mark_as_temp('otp', 120);
            if(!empty($_SESSION['otp'])){
                $message = 'Your OTP is '.$_SESSION['otp'].' Please never share your OTP (One Time Password) with anyone, This OTP is valid for 2 Mintues.';
                notify_user($message);
                $this->session->set_flashdata('message', 'OTP send on your registered mobile no.');
            }else{
                 $this->session->set_flashdata('message', 'ERROR:: OTP Failed!  ');
            }
            redirect('Admin/Settings/sendIncome/');
        }else{
            redirect('Dashboard/User/login');
        }
    }

    public function adminLoginOtp(){
        // if (is_admin()) {
            $_SESSION['login_otp'] = rand(100000, 999999);
            $this->session->mark_as_temp('login_otp', 120);
            if(!empty($_SESSION['login_otp'])){
                $message = 'Your OTP is '.$_SESSION['login_otp'].' Please never share your OTP (One Time Password) with anyone, This OTP is valid for 2 Mintues.';
                notify_user($message);
                $this->session->set_flashdata('message', 'OTP send on your registered mobile no.');
                // $response['message'] = 'OTP send on your registered mobile no.';
            }else{
                $this->session->set_flashdata('message', 'ERROR:: OTP Failed!');
                 // $response['message'] = 'ERROR:: OTP Failed!';
            }
            redirect('Admin/Settings/CreateEpins', $response);
        // }else{
        //     redirect('Admin/Management/login');
        // }
    }

    public function UpdateRank(){
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|xss_clean');
                $this->form_validation->set_rules('directs', 'Directs', 'trim|numeric|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $user = $this->Main_model->get_single_record('tbl_users', array('user_id' => $data['user_id']), '*');
                    if(!empty($user)){
                        $res = $this->Main_model->update('tbl_users', array('user_id' => $data['user_id']),array('directs' => $data['directs']));
                        if ($res == TRUE) {
                            $this->session->set_flashdata('message', 'Rank Updated Successfully');
                        } else {
                            $this->session->set_flashdata('message', 'Error While Updating Rank  Please Try Again ...');
                        }
                    }else{
                        $this->session->set_flashdata('message', 'Invalid user');
                    }
                }
            }
            $this->load->view('update_rank', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function CreateNews() {
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
                $this->form_validation->set_rules('news', 'News', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $packArr = array(
                        'title' => $data['title'],
                        'news' => $data['news'],
                    );
                    $res = $this->Main_model->add('tbl_news', $packArr);
                    if ($res == TRUE) {
                        $this->session->set_flashdata('message', 'News Added Successfully');
                    } else {
                        $this->session->set_flashdata('message', 'Error While Creating News  Please Try Again ...');
                    }
                }
            }
            $this->load->view('create_news', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function popup() {
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'doc|pdf|jpg|png';
                $config['file_name'] = 'am' . time();
                if($this->input->post('type') == 'image'){
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('media')) {
                        $this->session->set_flashdata('message', $this->upload->display_errors());
                    } else {
                        $data = array('upload_data' => $this->upload->data());
                        $promoArr = array(
                            'caption' => $this->input->post('caption'),
                            'media' => $data['upload_data']['file_name'],
                            'type' => 'image'
                        ); 
                        $res = $this->Main_model->update('tbl_popup', array('id' => 1),$promoArr);
                        if ($res) {
                            $this->session->set_flashdata('message', 'Image Update Successfully');
                        } else {
                            $this->session->set_flashdata('message', 'Error While Adding Popup Please Try Again ...');
                        }
                    }
                }else{
                    $promoArr = array(
                        'caption' => $this->input->post('caption'),
                        'media' => $this->input->post('media'),
                        'type' => 'video'
                    ); 
                    $res = $this->Main_model->update('tbl_popup', array('id' => 1),$promoArr);
                    if ($res) {
                        $this->session->set_flashdata('message', 'Image Updated Successfully');
                    } else {
                        $this->session->set_flashdata('message', 'Error While Adding Popup Please Try Again ...');
                    }
                }
                
            }
            $response['materials'] = $this->Main_model->get_records('tbl_popup', array(), '*');
            $this->load->view('popup', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function Epins($status) {
        if (is_admin()) {
            $response = array();
            if ($status == 0)
                $response['header'] = 'Unused Epins';
            elseif ($status == 1)
                $response['header'] = 'Used Epins';
            elseif ($status == 2)
                $response['header'] = 'Transferred';
            $config['base_url'] = base_url() . 'Admin/Settings/Epins/' . $status;
            $config['total_rows'] = $this->Main_model->get_sum('tbl_epins', array('status' => $status), 'ifnull(count(id),0) as sum');
            $config ['uri_segment'] = 5;
            $config['per_page'] = 50;
            $this->pagination->initialize($config);
            $segment = $this->uri->segment(5);
            $response['segament'] = $segment;
            $response['records'] = $this->Main_model->get_limit_records('tbl_epins', array('status' => $status), '*', $config['per_page'], $segment);
            $this->load->view('epins_list', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function income_management(){
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|xss_clean');
                $this->form_validation->set_rules('amount', 'Amount', 'trim|numeric|required|xss_clean');
                $this->form_validation->set_rules('description', 'Description', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $user = $this->Main_model->get_single_record('tbl_users', array('user_id' => $data['user_id']), 'user_id');
                    if (!empty($user)) {
                        $IncomeArr = array(
                            'user_id' => $data['user_id'],
                            'amount' => $data['amount'],
                            'type' => 'admin_amount',
                            'description' => $data['description'],
                        );
                        $res = $this->Main_model->add('tbl_income_wallet', $IncomeArr);
                        if ($res == TRUE) {
                            $this->session->set_flashdata('message', 'Amount Transferred Successfully');
                        } else {
                            $this->session->set_flashdata('message', 'Error While Transferring Amount  Please Try Again ...');
                        }
                    } else {
                        $this->session->set_flashdata('message', 'Invalid User ID');
                    }
                }
            }
            $this->load->view('income_management', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function CreateEpins() {
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
               // $this->session->set_flashdata('message', 'Please Wait');

                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|xss_clean');
                $this->form_validation->set_rules('pin_count', 'Pin Count', 'trim|numeric|required|xss_clean');
                $this->form_validation->set_rules('pin_amount', 'Pin Amount', 'trim|numeric|required|xss_clean');
                $this->form_validation->set_rules('master_key', 'Txn Pin', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    if($this->session->login_otp == $data['otp'] && !empty($this->session->login_otp)){
                        $user = $this->Main_model->get_single_record('tbl_users', array('user_id' => $data['user_id']), 'user_id');
                        if (!empty($user)) {
                            $master_key = $this->Main_model->get_single_record('tbl_admin',[],'*');
                            if($master_key['master_key'] == $data['master_key']){

                                $pin_count = $this->input->post('pin_count');
                                for ($i = 1; $i <= $pin_count; $i++) {
                                    $packArr = array(
                                        'user_id' => $data['user_id'],
                                        'epin' => $this->generate_pin(),
                                        'amount' => $data['pin_amount']
                                    );
                                    $res = $this->Main_model->add('tbl_epins', $packArr);
                                }
                                
                                if ($res == TRUE) {
                                    //$this->session->unset_userdata(array('login_otp'));
                                    $this->session->set_flashdata('message', 'Epins Generated Successfully');
                                } else {
                                    $this->session->set_flashdata('message', 'Error While Generating Epins  Please Try Again ...');
                                }
                            }else{
                                $this->session->set_flashdata('message', 'Invalid Master Key');
                            }
                        } else {
                            $this->session->set_flashdata('message', 'Invalid User ID');
                        }
                    }else{
                        $this->session->set_flashdata('message', 'ERROR:: Invalid OTP!');
                        
                    }
                }
            }
            $response['packages'] = $this->Main_model->get_records('tbl_package',[],'id,title,price');
            $this->load->view('create_epins', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function DebitEpins($user_id) {
        if (is_admin()) {
            $response = array();
            $response['available_pins'] = $this->Main_model->get_single_record('tbl_epins', array('user_id' => $user_id, 'status' => 0), 'ifnull(count(id),0) as available_pins');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('pin_count', 'Pin Count', 'trim|numeric|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $user = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user_id), 'user_id');
                    if (!empty($user)) {
                        $pin_count = $this->input->post('pin_count');
                        if ($pin_count <= $response['available_pins']['available_pins']) {
                            $res = $this->Main_model->delete_epins($user_id, $pin_count);
                            if ($res == TRUE) {
                                $this->session->set_flashdata('message', 'Epins Deleted Successfully');
                            } else {
                                $this->session->set_flashdata('message', 'Error While Generating Epins  Please Try Again ...');
                            }
                        } else {
                            $this->session->set_flashdata('message', 'Debit Limit is' . $response['available_pins']['available_pins']);
                        }
                    } else {
                        $this->session->set_flashdata('message', 'Invalid User ID');
                    }
                }
            }
            $response['available_pins'] = $this->Main_model->get_single_record('tbl_epins', array('user_id' => $user_id, 'status' => 0), 'ifnull(count(id),0) as available_pins');
            $this->load->view('debit_epins', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function generate_pin() {
        if (is_admin()) {
            $epin = md5(rand(100000, 9999999));
            $pin = $this->Main_model->get_single_record('tbl_epins', array('epin' => $epin), '*');
            if (!empty($pin)) {
                return $this->generate_pin();
            } else {
                return $epin;
            }
        }
    }
    public function UsersEPins() {
        if (is_admin()) {
            $response = array();
            $response['user_pins'] = $this->Main_model->user_epins();
            foreach($response['user_pins'] as $key => $pin_user){
                $response['user_pins'][$key]['user'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $pin_user['user_id']), 'name,phone');
            }
            $this->load->view('user_pins', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function UnusedEpins() {
        if (is_admin()) {
            $response = array();
            $response['user_pins'] = $this->Main_model->user_epins(array('status' => 0));
            foreach($response['user_pins'] as $key => $pin_user){
                $response['user_pins'][$key]['user'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $pin_user['user_id']), 'name,phone');
            }
            $this->load->view('user_pins', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function userPinView($user_id) {
        if (is_admin()) {
            $response = array();
            $response['pins'] = $this->Main_model->get_records('tbl_epins', array('user_id' => $user_id), '*');
            $this->load->view('user_pin_view', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function updatePassword() {
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('old_password', 'Old Password', 'trim|required|xss_clean');
                $this->form_validation->set_rules('new_password', 'New Password', 'trim|required|xss_clean');
                $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $oldPass = $this->Main_model->get_single_record('tbl_admin',array('user_id' => 'admin'),'password');
                    if($oldPass['password'] == $data['old_password']){
                        if($data['new_password'] == $data['confirm_password']){
                            $res = $this->Main_model->update('tbl_admin',array('user_id' => 'admin'),array('password' => $data['new_password']));
                            if ($res == TRUE) {
                                $this->session->set_flashdata('message', 'Password updated Successfully');
                                redirect('Admin/Settings/updatePassword');
                            } else {
                                $this->session->set_flashdata('message', 'Error While updating password, Please Try Again ...');
                            }
                        }else{
                            $this->session->set_flashdata('message', 'New Password & Confirm Password not matched'); 
                        }
                    }else{
                        $this->session->set_flashdata('message', 'Please enter correct old password'); 
                    }
                }
            }
            $this->load->view('passChange', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
}
