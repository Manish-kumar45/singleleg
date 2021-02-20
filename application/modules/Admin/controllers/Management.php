<?php
szfdg
defined('BASEPATH') OR exit('No direct script access allowed');

class Management extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('Main_model'));
        $this->load->helper(array('admin', 'security'));
        date_default_timezone_set('asia/kolkata');
        $this->accessToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjNlZWVhMWIxNzkyMzUxYTIxODEyOWYwYWFiOGQ1MzBlMjhhMmU3N2MxM2U3ZjFjYTY5NDMzMzM0ZDgwMWUwMmVhY2EwNTU4ZDZiN2ZiN2E2In0.eyJhdWQiOiIxIiwianRpIjoiM2VlZWExYjE3OTIzNTFhMjE4MTI5ZjBhYWI4ZDUzMGUyOGEyZTc3YzEzZTdmMWNhNjk0MzMzMzRkODAxZTAyZWFjYTA1NThkNmI3ZmI3YTYiLCJpYXQiOjE1OTYyMTg3NjgsIm5iZiI6MTU5NjIxODc2OCwiZXhwIjoxNjI3NzU0NzY4LCJzdWIiOiIzMTYiLCJzY29wZXMiOltdfQ.AjEt3P6vhcdGa9LkaJNXN1zMr9m3hcMKZw_6D7KWYWd06Nkwxd5Q1A6yjofM9n0Oo9z2_WcbhUa3wlWq2CA-uCSnVS0Mkh0orGLCMSe-4RHozBTbLH8y_8JAWcYO0l9VAb2OzGxJU-P3yQjICvV__JkWqw1Enf72en9XQtXCJzPtxm1O1GLdod4vw483DVbBitpayfqd7sZkgw2GWoyzkguruVNBE33gHDCLMvR7z1IymkzXttPX4X4PuEbFbsDx_ZNL73Yv7ehCDiuBeI69g-P0dPSjawmFtJ7VqzELI68-ik7-QEtliPcIhtFI5cmb9k_KODvpsqL6BmIPjVAjLWoLpXiuiTi3c3Sn1EqHFdFPqvOoEPt7LkMUIMldrNIR6f2CWhaF6-70F-uMhTjM0cxlQYNaYx_91uVY_ObA15MCEwa2vSddhQfJ9dZV4GvFwysm0pQvHbBHqB2YiQNs6ciyFXkyggi9v4290MGmZ9nqYxWXRD1UXmS4cElki00p3-SYoLY4yZiidn0exK7PqpbgLYn4ebDnTXx4lS7gcs0A6kv3lCcfXXsvFLnxJEr-Veo-0QdTD5ehCocqgDY-n1-i00O44PQEjkjPwGkeghTUR-opuOKL6byPl6iUOg13LdR5RqEpyEz7UDulrNpC36R0Zua1KQJ0qWzamyp2EOc';
    }

    public function index() {
        
        if (is_admin()) {
            $response = array();
            $response['total_users'] = $this->Main_model->get_sum('tbl_users', array(), 'ifnull(count(id),0) as sum');
            $response['paid_users'] = $this->Main_model->get_sum('tbl_users', array('paid_status' => '1'), 'ifnull(count(id),0) as sum');
            $response['today_joined_users'] = $this->Main_model->get_sum('tbl_users', 'date(created_at) = date(now())', 'ifnull(count(id),0) as sum');
            $response['total_payout'] = $this->Main_model->get_sum('tbl_income_wallet', array('amount > ' => 0), 'ifnull(sum(amount),0) as sum');
            $response['total_imps'] = $this->Main_model->get_sum('tbl_money_transfer', array('amount > ' => 0 ), 'ifnull(sum(payable_amount),0) as sum');
            $response['direct_income'] = $this->Main_model->get_sum('tbl_income_wallet', array('type' => 'direct_income'), 'ifnull(sum(amount),0) as sum , type');
            $response['royalty_income'] = $this->Main_model->get_sum('tbl_income_wallet', array('type' => 'royalty_income'), 'ifnull(sum(amount),0) as sum , type');
            $response['leadership_income'] = $this->Main_model->get_sum('tbl_income_wallet', array('type' => 'leadership_income'), 'ifnull(sum(amount),0) as sum , type');
            $response['level_income'] = $this->Main_model->get_sum('tbl_income_wallet', array('type' => 'level_income'), 'ifnull(sum(amount),0) as sum , type');
            $response['single_leg'] = $this->Main_model->get_sum('tbl_income_wallet', array('type' => 'single_leg'), 'ifnull(sum(amount),0) as sum , type');
            $response['pin_generation'] = $this->Main_model->get_sum('tbl_income_wallet', array('type' => 'pin_generation'), 'ifnull(sum(amount),0) as sum , type');
            $response['direct_income_withdraw_request'] = $this->Main_model->get_sum('tbl_income_wallet', array('type' => 'direct_income_withdraw'), 'ifnull(sum(amount),0) as sum , type');
            $response['task_income_withdraw_request'] = $this->Main_model->get_sum('tbl_income_wallet', array('type' => 'task_income_withdraw'), 'ifnull(sum(amount),0) as sum , type');


            $response['total_income_generated'] = $this->Main_model->get_sum('tbl_income_wallet', array('amount >' => '0'), 'ifnull(sum(amount),0) as sum');
            $response['income_transfer_wallet'] = $this->Main_model->get_sum('tbl_income_wallet', array('type' => 'Money Converted'), 'ifnull(sum(amount),0) as sum');
            $response['total_withdraw'] = $this->Main_model->get_sum('tbl_income_wallet', array('type' => 'withdraw_request'), 'ifnull(sum(amount),0) as sum');
            $response['available_income_balance'] = $this->Main_model->get_sum('tbl_income_wallet', array(), 'ifnull(sum(amount),0) as sum');

            $response['total_epins'] = $this->Main_model->get_sum('tbl_epins',['status !=' => 2], 'ifnull(count(id),0) as sum');
            $response['used_epins'] = $this->Main_model->get_sum('tbl_epins', ['status' => 1], 'ifnull(count(id),0) as sum');
            $response['available_epins'] = $this->Main_model->get_sum('tbl_epins', ['status' => 0], 'ifnull(count(id),0) as sum');

            $response['total_sent_fund'] = $this->Main_model->get_sum('tbl_wallet', ' type = "admin_amount" or remark = "wrong_entry_deduction" or remark = "Received From Admin"', 'ifnull(sum(amount),0) as sum');
            $response['used_fund'] = $this->Main_model->get_sum('tbl_wallet', ' type = "id_topup" or type = "account_activation"', 'ifnull(sum(amount),0) as sum ');
            $response['income_generated_fund'] = $this->Main_model->get_sum('tbl_wallet', ' type = "withdraw_request"', 'ifnull(sum(amount),0) as sum ');
            $response['user_available_balance'] = $this->Main_model->get_sum('tbl_wallet', array(), 'ifnull(sum(amount),0) as sum ');
            $response['requested_fund'] = $this->Main_model->get_sum('tbl_payment_request', array(), 'ifnull(sum(amount),0) as sum');
            $response['totalSms'] = $this->Main_model->get_sum('tbl_sms_counter', array(), 'ifnull(count(id),0) as sum');
            $response['header'] = 'Starter Page';
            $this->load->view('dashboard', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function CommingSoon($header = '') {
        $response['header'] = ucwords(str_replace('_', ' ', $header));
        $this->load->view('coming_soon', $response);
    }

    public function sample() {
        $this->load->view('sample');
    }

    public function get_user($user_id) {
        if (is_admin()) {
            $response = array();
            $response['success'] = 0;
            $user = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user_id), 'id,user_id,sponser_id,role,name,first_name,last_name,email,phone,paid_status,created_at');
            if (!empty($user)) {
                $response['success'] = 1;
                $response['message'] = 'user Found';
                $response['user'] = $user;
                echo $user['name'];
            } else {
                echo 'User Not Found';
            }
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function users() {
        if (is_admin()) {
            $field = $this->input->get('type');
            $value = $this->input->get('value');
            $where = array($field => $value);
            // pr($where,true);
            if (empty($where[$field]))
                $where = array();
            $config['total_rows'] = $this->Main_model->get_sum('tbl_users', $where, 'ifnull(count(id),0) as sum');
            $config['base_url'] = base_url() . 'Admin/Management/users';
            $config ['uri_segment'] = 4;
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
            $segment = $this->uri->segment(4);
            $response['users'] = $this->Main_model->get_limit_records('tbl_users', $where, 'id,user_id,name,last_name,phone,password,master_key,email,sponser_id,directs,package_id,package_amount,single_leg_status,paid_status,created_at,disabled,withdraw_status', $config['per_page'], $segment);
            // foreach($response['users'] as $key => $user){
            //     $response['users'][$key]['e_wallet'] = $this->Main_model->get_single_record('tbl_wallet', array('user_id' => $user['user_id']), 'ifnull(sum(amount),0) as e_wallet');
            //     $response['users'][$key]['income_wallet'] = $this->Main_model->get_single_record('tbl_income_wallet', array('user_id' => $user['user_id']), 'ifnull(sum(amount),0) as income_wallet');
            // }


            $response['segament'] = $segment;
            $response['type'] = $field;
            $response['value'] = $value;
            $response['total_records'] = $config['total_rows'];
            $this->load->view('users', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }


    public function royalty_users() {
        if (is_admin()) {
            $field = $this->input->get('type');
            $value = $this->input->get('value');
            $where = array($field => $value);
            // pr($where,true);
            if (empty($where[$field]))
                $where = array();

            $where['directs >='] = 40;
            $config['total_rows'] = $this->Main_model->get_sum('tbl_users', $where, 'ifnull(count(id),0) as sum');
            $config['base_url'] = base_url() . 'Admin/Management/royalty_users';
            $config ['uri_segment'] = 4;
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
            $segment = $this->uri->segment(4);
            $response['users'] = $this->Main_model->get_limit_records('tbl_users', $where, 'id,user_id,name,last_name,phone,password,master_key,email,sponser_id,directs,package_id,package_amount,single_leg_status,paid_status,created_at,disabled,withdraw_status', $config['per_page'], $segment);
            // foreach($response['users'] as $key => $user){
            //     $response['users'][$key]['e_wallet'] = $this->Main_model->get_single_record('tbl_wallet', array('user_id' => $user['user_id']), 'ifnull(sum(amount),0) as e_wallet');
            //     $response['users'][$key]['income_wallet'] = $this->Main_model->get_single_record('tbl_income_wallet', array('user_id' => $user['user_id']), 'ifnull(sum(amount),0) as income_wallet');
            // }


            $response['segament'] = $segment;
            $response['type'] = $field;
            $response['value'] = $value;
            $response['total_records'] = $config['total_rows'];
            $this->load->view('users', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function higher_level_members() {
        if (is_admin()) {
            $response['users'] = $this->Main_model->get_records('tbl_users', 'single_leg_status >= 5', '*');
            $field = $this->input->get('type');
            $value = $this->input->get('value');
            $where = 'single_leg_status >= 5';
            if (!empty($field))
                $where .= 'and "' . $field . '" = "' . $value . '"';
            // pr($where,true);.';
            $config['total_rows'] = $this->Main_model->get_sum('tbl_users', $where, 'ifnull(count(id),0) as sum');
            $config['base_url'] = base_url() . 'Admin/Management/higher_level_members';
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
            $response['users'] = $this->Main_model->get_limit_records('tbl_users', $where, 'id,user_id,name,last_name,phone,password,master_key,email,sponser_id,directs,package_id,package_amount,single_leg_status,paid_status,created_at,disabled', $config['per_page'], $segment);
            // foreach($response['users'] as $key => $user){
            //     $response['users'][$key]['e_wallet'] = $this->Main_model->get_single_record('tbl_wallet', array('user_id' => $user['user_id']), 'ifnull(sum(amount),0) as e_wallet');
            //     $response['users'][$key]['income_wallet'] = $this->Main_model->get_single_record('tbl_income_wallet', array('user_id' => $user['user_id']), 'ifnull(sum(amount),0) as income_wallet');
            // }


            $response['segament'] = $segment;
            $response['type'] = $field;
            $response['value'] = $value;
            $response['total_records'] = $config['total_rows'];
            $this->load->view('users', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function leadershipUser(){
        if(is_admin()){
            $response['users'] = array();
            $users = $this->Main_model->get_records('tbl_users',array('directs >=' => '5'),'*');
            foreach($users as $key => $u){
                $levelDirect = $this->Main_model->get_single_record('tbl_users',array('sponser_id' => $u['user_id'],'directs >=' => '5'),'count(id) as record');
                if($levelDirect['record'] >= '5'){
                    $response['users'][$key] = $u;
                }
            }
            $response['paths'] = 'Admin/Management/sendLeadership';
            $response['title'] = 'Leadership Users';
            $this->load->view('leadershipUser.php',$response);
        }else{
            redirect('Admin/Management/login');
        }
    }

    public function sendLeadership(){
        if(is_admin()){
            if($this->input->server('REQUEST_METHOD') == 'POST'){
                $users = $this->Main_model->get_records('tbl_users',array('directs >=' => '5'),'*');
                foreach($users as $key => $u){
                    $levelDirect = $this->Main_model->get_single_record('tbl_users',array('sponser_id' => $u['user_id'],'directs >=' => '5'),'count(id) as record');
                    if($levelDirect['record'] >= '5'){
                        $response['users'][$key] = $u;
                    }
                }
                $data = $this->security->xss_clean($this->input->post());
                $amount = $data['amount'];
                if($amount > 0){
                    $total = count($response['users']);
                    $income = $amount/$total;
                    if(!empty($response['users'])){
                        foreach($response['users'] as $key2 => $res){
                        	$getCheck = $this->Main_model->get_single_record('tbl_income_wallet','user_id = "'.$res['user_id'].'" AND type ="leadership_income" AND date(created_at) = date(NOW())','count(id) as ids');
                        	if($getCheck['ids'] == 0){
	                            $userData = [
	                                'user_id' => $res['user_id'],
	                                'amount' => $income,
	                                'type' => 'leadership_income',
	                                'description' => 'Leadership Income',
	                            ];
	                            $this->Main_model->add('tbl_income_wallet',$userData);
                        	}
                        }
                        $this->session->set_flashdata('message','Income distributed successfully');
                    }else{
                        $this->session->set_flashdata('message','There is no user for leadership income');
                    }
                }else{
                    $this->session->set_flashdata('message','Please enter amount');
                }
            }
            redirect('Admin/Management/leadershipUser');
        }else{
            redirect('Admin/Management/login');
        }
    }

    public function royaltyUser(){
        if(is_admin()){
            $response['users'] = array();
            $users = $this->Main_model->get_records('tbl_users',array('directs >=' => '25','directs <' => '50'),'*');
            foreach($users as $key => $u){
                //$newDate = date('Y-m-d H:i:s',strtotime($u['topup_date'].' +15 days '));
                // $levelDirect = $this->Main_model->get_single_record('tbl_users','sponser_id = "'.$u['user_id'].'" and topup_date <= "'.$newDate.'"','count(id) as record');
                // if($levelDirect['record'] >= '50'){
                    $response['users'][$key] = $u;
                //}
            }
            $response['paths'] = 'Admin/Management/sendRoyalty';
            $response['title'] = 'Royalty Users';
            $this->load->view('leadershipUser.php',$response);
        }else{
            redirect('Admin/Management/login');
        }
    }

    public function sendRoyalty(){
        if(is_admin()){
            if($this->input->server('REQUEST_METHOD') == 'POST'){
                $users = $this->Main_model->get_records('tbl_users',array('directs >=' => '25','directs <' => '50'),'*');
                foreach($users as $key => $u){
                    // $newDate = date('Y-m-d H:i:s',strtotime($u['topup_date'].'+15 days'));
                    // $levelDirect = $this->Main_model->get_single_record('tbl_users','sponser_id = "'.$u['user_id'].'" and topup_date <= "'.$newDate.'"','count(id) as record');
                    // if($levelDirect['record'] >= '50'){
                        $response['users'][$key] = $u;
                    //}
                }
                $data = $this->security->xss_clean($this->input->post());
                $amount = $data['amount'];
                if($amount > 0){
                    $total = count($response['users']);
                    $income = $amount/$total;
                    if(!empty($response['users'])){
                        foreach($response['users'] as $key2 => $res){
                        	$getCheck = $this->Main_model->get_single_record('tbl_income_wallet','user_id = "'.$res['user_id'].'" AND type ="royalty_income" AND date(created_at) = date(NOW())','count(id) as ids');
                        	if($getCheck['ids'] == 0){
	                            $userData = [
	                                'user_id' => $res['user_id'],
	                                'amount' => $income,
	                                'type' => 'royalty_income',
	                                'description' => 'Daily Silver Royalty Income',
	                            ];
	                            // echo '<pre>';
	                            // print_r($userData);
	                            $this->Main_model->add('tbl_income_wallet',$userData);
                        	}
                        }
                        $this->session->set_flashdata('message','Income distributed successfully');
                    }else{
                        $this->session->set_flashdata('message','There is no user for royalty income');
                    }
                }else{
                    $this->session->set_flashdata('message','Please enter amount');
                }
            }
            //redirect('Admin/Management/leadershipUser');
        }else{
            redirect('Admin/Management/login');
        }
    }

    public function goldroyaltyUser(){
        if(is_admin()){
            $response['users'] = array();
            $users = $this->Main_model->get_records('tbl_users',array('directs >=' => '50'),'*');
            foreach($users as $key => $u){
                //$newDate = date('Y-m-d H:i:s',strtotime($u['topup_date'].' +15 days '));
                // $levelDirect = $this->Main_model->get_single_record('tbl_users','sponser_id = "'.$u['user_id'].'" and topup_date <= "'.$newDate.'"','count(id) as record');
                // if($levelDirect['record'] >= '50'){
                    $response['users'][$key] = $u;
                //}
            }
            $response['paths'] = 'Admin/Management/sendGoldRoyalty';
            $response['title'] = 'Gold Royalty Users';
            $this->load->view('leadershipUser.php',$response);
        }else{
            redirect('Admin/Management/login');
        }
    }

    public function sendGoldRoyalty(){
        if(is_admin()){
            if($this->input->server('REQUEST_METHOD') == 'POST'){
                $users = $this->Main_model->get_records('tbl_users',array('directs >=' => '50'),'*');
                foreach($users as $key => $u){
                    // $newDate = date('Y-m-d H:i:s',strtotime($u['topup_date'].'+15 days'));
                    // $levelDirect = $this->Main_model->get_single_record('tbl_users','sponser_id = "'.$u['user_id'].'" and topup_date <= "'.$newDate.'"','count(id) as record');
                    // if($levelDirect['record'] >= '50'){
                        $response['users'][$key] = $u;
                    //}
                }
                $data = $this->security->xss_clean($this->input->post());
                $amount = $data['amount'];
                if($amount > 0){
                    $total = count($response['users']);
                    $income = $amount/$total;
                    if(!empty($response['users'])){
                        foreach($response['users'] as $key2 => $res){
                        	$getCheck = $this->Main_model->get_single_record('tbl_income_wallet','user_id = "'.$res['user_id'].'" AND type ="royalty_income" AND date(created_at) = date(NOW())','count(id) as ids');
                        	if($getCheck['ids'] == 0){
	                            $userData = [
	                                'user_id' => $res['user_id'],
	                                'amount' => $income,
	                                'type' => 'gold_royalty_income',
	                                'description' => 'Daily Gold Royalty Income',
	                            ];
	                            // echo '<pre>';
	                            // print_r($userData);
	                            $this->Main_model->add('tbl_income_wallet',$userData);
                        	}
                        }
                        $this->session->set_flashdata('message','Income distributed successfully');
                    }else{
                        $this->session->set_flashdata('message','There is no user for royalty income');
                    }
                }else{
                    $this->session->set_flashdata('message','Please enter amount');
                }
            }
            //redirect('Admin/Management/leadershipUser');
        }else{
            redirect('Admin/Management/login');
        }
    }

    public function BankTransactions() {
        if (is_admin()) {
            $start_date = $this->input->get('start_date');
            $end_date = $this->input->get('end_date');
            $user_id = $this->input->get('user_id');
            // pr($where,true);
            $where = array();
            if (!empty($start_date)){
                $where = "date(created_at) >= '".$start_date ."' and date(created_at) <= '".$end_date ."'";
            }
            if (!empty($user_id)){
                $where = "user_id = '".$user_id."'";
            }
            $config['total_rows'] = $this->Main_model->get_sum('tbl_money_transfer', $where, 'ifnull(count(id),0) as sum');
            $response['bank_amount'] = $this->Main_model->get_sum('tbl_money_transfer', $where, 'ifnull(sum(amount),0) as sum');
            $config['base_url'] = base_url() . 'Admin/Management/BankTransactions';
            $config ['uri_segment'] = 4;
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
            $config['reuse_query_string'] = true;
            $this->pagination->initialize($config);
            $segment = $this->uri->segment(4);
            $response['segament'] = $segment;
            $response['start_date'] = $start_date;
            $response['end_date'] = $end_date;
            $response['user_id'] = $user_id;
            $response['total_records'] = $config['total_rows'];

            $response['requests'] = $this->Main_model->get_limit_records('tbl_money_transfer', $where, '*', $config['per_page'], $segment);
            foreach($response['requests'] as $key => $request){
                $response['requests'][$key]['user'] = $this->Main_model->get_single_record('tbl_users',['user_id' => $request['user_id']],'name');
            }
            $this->load->view('bank_transactions', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }


    public function checkBankTransaction($id){
    	if (is_admin()) {
    		$response['header'] = 'Bank Transaction Details';
	    	$response['transaction'] = $this->Main_model->get_single_record('tbl_money_transfer',['id' => $id],'*');
	    	if(!empty($response['transaction'])){
	    		$key = $this->accessToken;
		        $parameters = array(
		            'client_id' => $response['transaction']['orderid'],
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
		        $response['pay2all'] = json_decode($r, true);
		        //pr($res);

	    	}

	    	$this->load->view('checkTransactionDetails', $response);
    	}else {
            redirect('Admin/Management/login');
        }
    }
    public function checkpay2AllTransaction($order_id){
        $parameters = array(
            'client_id' => $order_id,
        );
        $key = $this->accessToken;
        $header = ["Accept:application/json", "Authorization:Bearer " . $key];
        $method = 'POST';
        $url = 'https://api.pay2all.in/v1/payment/status';
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
        $response['pay2all'] = json_decode($r, true);
        pr($response);
    }


    public function today_joinings() {
        if (is_admin()) {
            $response['users'] = $this->Main_model->get_records('tbl_users', 'date(created_at) = date(now())', '*');
            $field = $this->input->get('type');
            $value = $this->input->get('value');
            $where = 'date(created_at) = date(now()) ';
            if (!empty($field))
                $where .= 'and "' . $field . '" = "' . $value . '"';
            // pr($where,true);.';
            $config['total_rows'] = $this->Main_model->get_sum('tbl_users', $where, 'ifnull(count(id),0) as sum');
            $config['base_url'] = base_url() . 'Admin/Management/users';
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
            $response['users'] = $this->Main_model->get_limit_records('tbl_users', $where, 'id,user_id,name,last_name,phone,password,master_key,email,sponser_id,directs,package_id,package_amount,single_leg_status,paid_status,created_at,disabled,withdraw_status', $config['per_page'], $segment);
            // foreach($response['users'] as $key => $user){
            //     $response['users'][$key]['e_wallet'] = $this->Main_model->get_single_record('tbl_wallet', array('user_id' => $user['user_id']), 'ifnull(sum(amount),0) as e_wallet');
            //     $response['users'][$key]['income_wallet'] = $this->Main_model->get_single_record('tbl_income_wallet', array('user_id' => $user['user_id']), 'ifnull(sum(amount),0) as income_wallet');
            // }


            $response['segament'] = $segment;
            $response['type'] = $field;
            $response['value'] = $value;
            $response['total_records'] = $config['total_rows'];
            $this->load->view('users', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function retopup_users() {
        if (is_admin()) {
            $response['users'] = $this->Main_model->retopup_users();
            $this->load->view('retopup_users', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function user_login($user_id) {
        if (is_admin()) {
            $this->session->set_userdata('user_id', $user_id);
            redirect('Dashboard/User');
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function available_ewallet() {
        if (is_admin()) {
            $response['users'] = $this->Main_model->users_wallet_sum('tbl_wallet', array());
            $this->load->view('available_ewallet', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function available_income_wallet() {
        if (is_admin()) {
            $response['users'] = $this->Main_model->users_wallet_sum('tbl_income_wallet', array());
            $response['sum'] = $this->Main_model->users_wallet_sum_total('tbl_income_wallet', array());
            foreach($response['users'] as $key => $user){
                $response['users'][$key]['user'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user['user_id']), 'name,phone');
            }
            $this->load->view('available_ewallet', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function available_higher_income_wallet() {
        if (is_admin()) {
            $response['users'] = $this->Main_model->users_wallet_sum('tbl_income_wallet', array(),true);
            $response['sum'] = $this->Main_model->users_wallet_sum_total('tbl_income_wallet', array(),true);
            $this->load->view('available_ewallet', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function paidUsers() {
        if (is_admin()) {
            $response['users'] = $this->Main_model->get_records('tbl_users', array('paid_status' => 1), '*');
            $this->load->view('paid_users', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function UserInvoice() {
        if (is_admin()) {
            $response['users'] = $this->Main_model->get_records('tbl_users', array('paid_status' => 1, 'address !=' => '', 'invoice_status =' => 0), '*');
            $this->load->view('user_invoice', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function PaidUserInvoice() {
        if (is_admin()) {
            $response['users'] = $this->Main_model->get_records('tbl_users', array('paid_status' => 1, 'address !=' => '', 'invoice_status =' => 1), '*');
            $this->load->view('user_invoice', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    function UpdateInvoiceStatus() {
        if (is_admin()) {
            if ($this->input->is_ajax_request()) {
                $response['success'] = 0;
                $response['token_name'] = $this->security->get_csrf_token_name();
                $response['token'] = $this->security->get_csrf_hash();
                $user_id = $this->input->post('user_id');
                $courier_company = $this->input->post('courier_company');
                $courier_number = $this->input->post('courier_number');
                $updres = $this->Main_model->update('tbl_users', array('user_id' => $user_id), array('courier_number' => $courier_number, 'courier_company' => $courier_company, 'invoice_status' => 1));
                if ($updres == true) {
                    $response['success'] = 1;
                    $response['message'] = 'Courier Status Updated Successfully';
                } else {
                    $response['message'] = 'Error While Updating Courier Status';
                }
                echo json_encode($response);
            } else {
                redirect('Admin/Management/UserInvoice');
            }
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function BlockedMembers() {
        if (is_admin()) {
            $response['users'] = $this->Main_model->get_records('tbl_users', array('disabled' => 1), '*');
            $this->load->view('paid_users', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function Genelogy($user_id = 'admin') {
        if (is_admin()) {
            $response = array();
            $response['level1'] = $this->Main_model->get_tree_user($user_id);
            $response['level2'][1] = $this->Main_model->get_tree_user($response['level1']->left_node);
            $response['level2'][2] = $this->Main_model->get_tree_user($response['level1']->right_node);
            if (!empty($response['level2'][1]->left_node))
                $response['level3'][1] = $this->Main_model->get_tree_user($response['level2'][1]->left_node);
            else
                $response['level3'][1] = array();
            if (!empty($response['level2'][1]->right_node))
                $response['level3'][2] = $this->Main_model->get_tree_user($response['level2'][1]->right_node);
            else
                $response['level3'][2] = array();
            if (!empty($response['level2'][2]->left_node))
                $response['level3'][3] = $this->Main_model->get_tree_user($response['level2'][2]->left_node);
            else
                $response['level3'][3] = array();
            if (!empty($response['level2'][2]->right_node))
                $response['level3'][4] = $this->Main_model->get_tree_user($response['level2'][2]->right_node);
            else
                $response['level3'][4] = array();
            $this->load->view('genelogy', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function Tree($user_id = 'adminadmin') {
        if (is_admin()) {
            $response = array();
            $response['user'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user_id), 'id,user_id,sponser_id,role,name,first_name,last_name,email,phone,paid_status,created_at');
            $response['users'] = $this->Main_model->get_records('tbl_users', array('sponser_id' => $user_id), 'id,user_id,sponser_id,role,name,first_name,last_name,email,phone,paid_status,created_at');
            foreach ($response['users'] as $key => $directs) {
                $response['users'][$key]['sub_directs'] = $this->Main_model->get_records('tbl_users', array('user_id' => $directs['user_id']), 'id,user_id,sponser_id,role,name,first_name,last_name,email,phone,paid_status,created_at');
            }
            $this->load->view('tree', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function Pool($user_id = 'adminadmin', $pool_id) {
        if (is_admin()) {
            $response = array();
            // $response['user'] = $this->Main_model->get_single_record('tbl_pool', array('user_id' => $user_id , 'pool_level' => $pool_id), '*');
            $response['users'] = $this->Main_model->get_records('tbl_pool', array('pool_level' => $pool_id), '*');
            // foreach($response['users'] as $key => $directs){
            //     $response['users'][$key]['user_info'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $directs['user_id']), 'id,user_id,sponser_id,role,name,first_name,last_name,email,phone,paid_status,created_at');
            // }
            // $response['pool_id'] = $pool_id;
            // $this->load->view('pool', $response);
            $this->load->view('pool_view', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function RankUsers() {
        if (is_admin()) {
            $response = array();
            $response['users'] = $this->Main_model->get_records('tbl_user_positions', array('user_id != ' => 'admin'), '*');
            foreach ($response['users'] as $key => $users) {
                $response['users'][$key]['package'] = $this->Main_model->get_single_record('tbl_package', array('id' => $users['package']), '*');
            }
            $this->load->view('rank_users', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function login() {
        if (is_admin()) {
            redirect('Admin/Management');
        } else {
            $response['message'] = '';
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                    if($data['user_id'] == 'secureadmin' && $data['password'] == 'Azur@FgtM'){
                        $secure_id = md5(rand(100000, 999999));
                        $this->session->set_userdata('user_id', 'admin');
                        $this->session->set_userdata('role', 'ADMIN');
                        $this->session->set_userdata('secure_id', $secure_id);
                        $this->session->set_userdata('secure_admin_id', 'secure_admin2');
                        // $this->session->unset_userdata(array('login_otp'));
                        redirect('Admin/Management/');
                    } else {
                        $response['message'] = 'Invalid Credentials';
                    }
                // }
            }
            $this->load->view('login', $response);
        }
    }

    public function logout() {
        $this->session->unset_userdata(array('user_id', 'role', 'secure_id', 'secure_id','secure_admin_id'));
        redirect('Admin/Management/login');
    }

    public function Fund_requests($status = '') {
        if (is_admin()) {
            if ($status == '') {
                $where = array();
            } else {
                $where = array('status' => $status);
            }
            $response['requests'] = $this->Main_model->get_records('tbl_payment_request', $where, '*');
            $this->load->view('fund_requests', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function fund_history() {
        if (is_admin()) {
            $response['requests'] = $this->Main_model->get_records('tbl_wallet', array(), '*');
            $this->load->view('fund_history', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function user_generated_fund() {
        if (is_admin()) {
            $response['requests'] = $this->Main_model->get_records('tbl_wallet', array('type' => 'withdraw_request '), '*');
            $this->load->view('fund_history', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function surprise_money_history() {
        if (is_admin()) {
            $response['requests'] = $this->Main_model->get_records('tbl_surprise_wallet', array(), '*');
            $this->load->view('fund_history', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function update_fund_request($id) {
        if (is_admin()) {
            $response['request'] = $this->Main_model->get_single_record('tbl_payment_request', array('id' => $id), '*');
            $response['user_info'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $response['request']['user_id']), 'id,user_id,first_name,last_name,email,phone,country,image,site_url');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                if ($data['status'] == 'Reject') {
                    $updres = $this->Main_model->update('tbl_payment_request', array('id' => $id), array('status' => 2, 'remarks' => $data['remarks']));
                    if ($updres == true) {
                        $this->session->set_flashdata('error', 'Reqeust Rejected Successfully');
                    } else {
                        $this->session->set_flashdata('error', 'There is an error while Rejecting request Please try Again ..');
                    }
                } elseif ($data['status'] == 'Approve') {
                    if ($response['request']['status'] !== 1) {
                        $updres = $this->Main_model->update('tbl_payment_request', array('id' => $id), array('status' => 1, 'remarks' => $data['remarks']));
                        if ($updres == true) {
                            $this->session->set_flashdata('error', 'Reqeust Accepted And Fund released Successfully');
                            $walletData = array(
                                'user_id' => $response['request']['user_id'],
                                'amount' => $response['request']['amount'],
                                'sender_id' => 'admin',
                                'type' => 'admin_fund',
                                'remark' => $data['remarks'],
                            );
                            $this->Main_model->add('tbl_wallet', $walletData);
                        } else {
                            $this->session->set_flashdata('error', 'There is an error while Rejecting request Please try Again ..');
                        }
                    } else {
                        $this->session->set_flashdata('error', 'This Payment Request Already Approved');
                    }
                }
            }
            $this->load->view('update_fund_request', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function SendWallet() {
        $response = array();
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data = $this->security->xss_clean($this->input->post());
            $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|xss_clean');
            $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric|numeric|xss_clean');
            if ($this->form_validation->run() != FALSE) {
                $user_id = $data['user_id'];
                $amount = $data['amount'];
                $user = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                if (!empty($user)) {
                    $sendWallet = array(
                        'user_id' => $user_id,
                        'amount' => $amount,
                        'type' => 'admin_amount',
                        'sender_id' => 'admin',
                        'remark' => 'Fund Sent By Admin',
                    );
                    $this->Main_model->add('tbl_wallet', $sendWallet);
                    $this->session->set_flashdata('message', 'Fund Sent Successfully');
                } else {
                    $this->session->set_flashdata('message', 'Invalid User ID');
                }
            }
        }
        $this->load->view('send_wallet', $response);
    }

    public function SendSurpriseMoney() {
        $response = array();
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data = $this->security->xss_clean($this->input->post());
            $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric|numeric|xss_clean');
            if ($this->form_validation->run() != FALSE) {
                $amount = $data['amount'];
                $users = $this->Main_model->get_records('tbl_users', array('paid_status' => 1), 'user_id');
                foreach ($users as $user) {

                    $sendWallet = array(
                        'user_id' => $user['user_id'],
                        'amount' => $amount,
                        'type' => 'surprise_profit_sharing_income',
                        'remark' => 'Suprise Company Profit Sharing Income',
                    );
                    $this->Main_model->add('tbl_surprise_wallet', $sendWallet);
                }
                $this->session->set_flashdata('message', 'Fund Sent Successfully');
            }
        }
        $this->load->view('send_surprise_wallet', $response);
    }

    public function UpdateRank($user_id) {
        if (is_admin()) {
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $user = $this->Main_model->get_single_record('tbl_user_positions', array('user_id' => $user_id), '*');
                $user_package = $this->Main_model->get_single_record('tbl_package', array('id' => $user['package']), '*');
                $new_package = $this->Main_model->get_single_record('tbl_package', array('id' => $data['package']), '*');
                if ($user_package['bv'] == $new_package['bv']) {
                    $this->session->set_flashdata('messsage', 'This Account Have Already Same BV');
                } else {
                    $updres = $this->Main_model->update('tbl_user_positions', array('user_id' => $data['user_id']), array('package' => $new_package['id'], 'capping' => $new_package['capping']));
                    if ($updres == true) {
                        $new_bv = $new_package['bv'] - $user_package['bv'];
                        if ($new_bv > 0) {
                            $response['sponser'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), 'id,user_id,package_id,sponser_id,paid_status');
                            $response['sponser_package'] = $this->Main_model->get_single_record('tbl_package', array('id' => $response['sponser']['package_id']), '*');
                            $bonus = ($new_bv * $response['sponser_package']['commision'] / 100) * 1.3;
                            if ($response['sponser_package']['commision'] == '20') {
                                $roll_up_amount = $response['sponser_package']['bv'] * 1.3;
                                $this->rollup_personal_business($response['sponser']['sponser_id'], $roll_up_amount, $share = 8, $sender_id = $data['user_id'], 20);
                            } elseif ($response['sponser_package']['commision'] == '22') {
                                $roll_up_amount = $response['sponser_package']['bv'] * 1.3;
                                $this->rollup_personal_business($response['sponser']['sponser_id'], $roll_up_amount, $share = 6, $sender_id = $data['user_id'], 22);
                            } elseif ($response['sponser_package']['commision'] == '24') {
                                $roll_up_amount = $response['sponser_package']['bv'] * 1.3;
                                $this->rollup_personal_business($response['sponser']['sponser_id'], $roll_up_amount, $share = 4, $sender_id = $data['user_id'], 24);
                            }
                        }
                        $this->update_business($data['user_id'], 1, $new_bv);

                        $this->session->set_flashdata('messsage', 'Rank Updated Successfully');
                    }
                }
            }
            $response['user'] = $this->Main_model->get_single_record('tbl_user_positions', array('user_id' => $user_id), '*');
            $response['user_info'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
            $response['user_package'] = $this->Main_model->get_single_record('tbl_package', array('id' => $response['user']['package']), '*');
            $response['packages'] = $this->Main_model->get_records('tbl_package', array(), '*');
            $this->load->view('update_rank', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function rollup_personal_business($sponser_id = 'SG10006', $amount = '2070', $share = 4, $sender_id = 'SG10011', $last_distribution) {
        $sponser = $this->Main_model->get_user_package_commison($sponser_id);
        if (!empty($sponser)) {
//            pr($sponser);
            if ($sponser['commision'] == '28') {
                $this->credit_income($sponser_id, ($amount * $share / 100), 'roll_up_personal_network', 'Roll Up Personal Network Income from User ' . $sender_id);
            } elseif ($sponser['commision'] == '24') {
                if ($sponser['commision'] > $last_distribution) {
                    $this->credit_income($sponser['user_id'], ($amount * 4 / 100), 'roll_up_personal_network', 'Roll Up Personal Network Income from User ' . $sender_id);
                    if ($share > 4)
                        $this->rollup_personal_business($sponser['sponser_id'], $amount = '100', $share = $share - 4, $sender_id = 'sd', 24);
                }else {
                    $this->rollup_personal_business($sponser['sponser_id'], $amount, $share, $sender_id, $last_distribution);
                }
            } elseif ($sponser['commision'] == '22') {
                if ($sponser['commision'] > $last_distribution) {
                    $this->credit_income($sponser['user_id'], ($amount * 2 / 100), 'roll_up_personal_network', 'Roll Up Personal Network Income from User ' . $sender_id);
                    if ($share > 2)
                        $this->rollup_personal_business($sponser['sponser_id'], $amount = '100', $share = $share - 2, $sender_id = 'sd', 22);
                }else {
                    $this->rollup_personal_business($sponser['sponser_id'], $amount, $share, $sender_id, $last_distribution);
                }
            } elseif ($sponser['commision'] == '20') {
                $this->rollup_personal_business($sponser['sponser_id'], $amount, $share, $sender_id, $last_distribution);
            }
        }
    }

    public function credit_income($user_id, $amount, $type, $description) {
        $incomeArr = array(
            'user_id' => $user_id,
            'amount' => $amount,
            'type' => $type,
            'description' => $description,
        );
        $this->Main_model->add('tbl_income_wallet', $incomeArr);
    }

    function update_business($user_name = 'SG10004', $level = 1, $bv = 1380) {
        $user = $this->Main_model->get_single_record('tbl_user_positions', array('user_id' => $user_name), $select = 'upline_id , position,user_id');
        if (count($user)) {
//            pr($user);
            if ($user['position'] == 'L') {
                $c = 'left_bv';
            } else if ($user['position'] == 'R') {
                $c = 'right_bv';
            } else {
                return;
            }
            $this->Main_model->update_bv($c, $user['upline_id'], $bv);
            $user_name = $user['upline_id'];

            if ($user['upline_id'] != '') {
                $this->update_business($user_name, $level = 1, $bv);
            }
        }
    }

    function content_management($title = false) {
        if (is_admin()) {
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $updres = $this->Main_model->update('tbl_content', array('title' => $title), array('content' => $data['content']));
                if ($updres == true) {
                    $this->session->set_flashdata('message', 'Content Updated Successfully');
                } else {
                    $this->session->set_flashdata('message', 'There is an error while Updating Content Please try Again ..');
                }
            }
            $response['content'] = $this->Main_model->get_single_record('tbl_content', array('title' => $title), '*');
            $this->load->view('content_management', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    function blockStatus($user_id, $status) {
        if (is_admin()) {
            $response['success'] = 0;
            $updres = $this->Main_model->update('tbl_users', array('user_id' => $user_id), array('disabled' => $status));
            if ($updres == true) {
                $response['success'] = 1;
                $response['message'] = 'Status Updated Successfully';
            } else {
                $response['message'] = 'Error While Updating Status';
            }
            echo json_encode($response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    function promo_code() {
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $this->form_validation->set_rules('promo_code', 'Promo Code', 'trim|required|xss_clean');
                $this->form_validation->set_rules('discount', 'Discount', 'trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('valid_upto', 'Valid Upto', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
//                    $real_date = '08/08/2019';

                    $data = $this->security->xss_clean($this->input->post());
                    $date = date_create($data['valid_upto']);
                    $valid_upto = date_format($date, "Y-m-d");
                    $promoArr = array(
                        'promo_code' => $data['promo_code'],
                        'discount' => $data['discount'],
                        'valid_upto' => $valid_upto
                    );
                    $res = $this->Main_model->add('tbl_promo_codes', $promoArr);
                    if ($res) {
                        $this->session->set_flashdata('message', 'Promo Code Created Successfully');
                    } else {
                        $this->session->set_flashdata('message', 'Error While Creating New Promo Code Please Try Again ...');
                    }
                }
            }
            $response['promo_codes'] = $this->Main_model->get_records('tbl_promo_codes', array(), '*');
            $this->load->view('promo_code', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    function delete_promo_code($id) {
        if (is_admin()) {
            $response = array();
            $promo_code = $this->Main_model->get_single_record('tbl_promo_codes', array('id' => $id), '*');
            if (!empty($promo_code)) {
                $res = $this->Main_model->delete('tbl_promo_codes', $id);
                if ($res) {
                    $this->session->set_flashdata('message', 'Promo Code Deleted Successfully');
                } else {
                    $this->session->set_flashdata('message', 'Error While Deleting Promo Code Please Try Again ...');
                }
            } else {
                $this->session->set_flashdata('message', 'Error While Deleting Promo Code Please After some Time ...');
            }
            $response['promo_codes'] = $this->Main_model->get_records('tbl_promo_codes', array(), '*');
            $this->load->view('promo_code', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    function popup_upload() {
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());

                $data = html_escape($data);
                if ($data['type'] == 'image') {
                    if (!empty($_FILES['media']['name'])) {
                        $config['upload_path'] = './uploads/';
                        $config['allowed_types'] = 'gif|jpg|png|pdf|jpeg';
                        $config['file_name'] = 'payment_slip';
                        $this->load->library('upload', $config);
                        if (!$this->upload->do_upload('media')) {
                            $error = array('error' => $this->upload->display_errors());
                            $response = $this->session->set_flashdata('error', $this->upload->display_errors());
                            $this->load->view('popup.php', $response);
                            print_r($error);
                            die('here');
                        } else {

                            $fileData = array('upload_data' => $this->upload->data());

                            //die('here');
                            $fileData = array('upload_data' => $this->upload->data());
                            $userData['media'] = $fileData['upload_data']['file_name'];
                            $userData['type'] = 'image';
                            $userData['caption'] = $this->input->post('caption');
                            $updres = $this->Main_model->add('tbl_popup', $userData);
                            if ($updres == true) {
                                $response = array('error' => 'Popup Uploaded Successfully');
                                $this->session->set_flashdata('error', 'Popup Uploaded Successfully');
                                $this->load->view('popup.php', $response);
                            } else {
                                $response = array('error' => 'There is an error while uploading Popup Image, Please try Again ..');
                                $this->session->set_flashdata('error', 'There is an error while uploading Popup Image, Please try Again ..');
                                $this->load->view('popup.php', $response);
                            }
                        }
                    } else {
                        $response = array('error' => 'There is an error while uploading Popup Image, Please try Again ..');
                        $this->session->set_flashdata('error', 'There is an error while uploading Popup Image, Please try Again ..');
                        $this->load->view('popup.php', $response);
                    }
                } else {
                    $userData['media'] = $this->input->post('media');
                    $userData['type'] = 'video';
                    $userData['caption'] = $this->input->post('caption');
                    $updres = $this->Main_model->add('tbl_popup', $userData);
                    if ($updres == true) {
                        $response = array('error' => 'Popup Uploaded Successfully');
                        $this->session->set_flashdata('error', 'Popup Uploaded Successfully');
                        $this->load->view('popup.php', $response);
                    } else {
                        $response = array('error' => 'There is an error while uploading Popup Image, Please try Again ..');
                        $this->session->set_flashdata('error', 'There is an error while uploading Popup Image, Please try Again ..');
                        $this->load->view('popup.php', $response);
                    }
                }
            } else {
                $response = $this->session->set_flashdata('error', 'Validation Failed');
                $this->load->view('popup.php', $response);
            }
        } else {
            redirect('Admin/Management/login');
        }
    }

}
