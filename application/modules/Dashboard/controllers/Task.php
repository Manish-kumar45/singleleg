<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('User_model'));
        $this->load->helper(array('user', 'birthdate', 'security', 'email'));
    }

    public function index() {
        if (is_logged_in()) {
            $response['task_links'] = $this->User_model->get_records('tbl_task_links', array(), '*');
            // foreach($response['task_links'] as $key => $link){
            //     $response['task_links'][$key]['counter'] = $this->User_model->get_single_record('tbl_task_counter', "user_id = '".$this->session->userdata['user_id']."' and date(created_at) = date(NOW()) and task_id = '".$link['id']."'", '*');
            // }
            $response['task'] = $this->User_model->get_single_record('tbl_task', "user_id = '".$this->session->userdata['user_id']."' and date(created_at) = date(NOW())", '*');
            $this->load->view('admin_task', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function MemberTasks() {
        if (is_logged_in()) {
            $response['task_links'] = $this->User_model->get_records('tbl_channel_links', array(), '*');
            foreach($response['task_links'] as $key => $link){
                $response['task_links'][$key]['counter'] = $this->User_model->get_single_record('tbl_task_counter', "user_id = '".$this->session->userdata['user_id']."' and date(created_at) = date(NOW()) and task_id = '".$link['id']."'", '*');
            }
            $response['task'] = $this->User_model->get_single_record('tbl_task', "user_id = '".$this->session->userdata['user_id']."' and date(created_at) = date(NOW())", '*');
            $this->load->view('task', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function TaskPoints() {
        if (is_logged_in()) {
            $response['task_links'] = $this->User_model->get_records('tbl_points', array('user_id' => $this->session->userdata['user_id']), '*');
            // foreach($response['task_links'] as $key => $link){
            //     $response['task_links'][$key]['counter'] = $this->User_model->get_single_record('tbl_task_counter', "user_id = '".$this->session->userdata['user_id']."' and date(created_at) = date(NOW()) and task_id = '".$link['id']."'", '*');
            // }
            // $response['task'] = $this->User_model->get_single_record('tbl_task', "user_id = '".$this->session->userdata['user_id']."' and date(created_at) = date(NOW())", '*');
            $this->load->view('task_points', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function TaskPerform() {
        if (is_logged_in()) {
            $response['task'] = $this->User_model->get_single_record('tbl_task', "user_id = '".$this->session->userdata['user_id']."' and date(created_at) = date(NOW())", '*');
            $this->load->view('task_perform', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function ROILIST($type) {
        if (is_logged_in()) {
            $response['header'] = str_replace('_' ,' ' , $type);
            $response['records'] = $this->User_model->get_records('tbl_roi',array('user_id' => $this->session->userdata['user_id'] , 'type' => $type ), '*');
            $this->load->view('roi_list', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function AddVideo() {
        if (is_logged_in()) {
            $data = array();
            $data['success'] = 0;
            $data['token_name'] = $this->security->get_csrf_token_name();
            $data['token_value'] = $this->security->get_csrf_hash();
            $TaskCounterIncome = array(
                'user_id' => $this->session->userdata['user_id'],
                'video_url' => $this->input->post('video_url'),
            );
            $this->User_model->add('tbl_user_videos', $TaskCounterIncome);
            $data['success'] = 1;
            $data['message'] = 'Video Added Completed Successfully';
            echo json_encode($data);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function TaskComplete($task_id){
        if (is_logged_in()) {
            $data['success'] = 0;
            $task = $this->User_model->get_single_record('tbl_task', "user_id = '".$this->session->userdata['user_id']."' and date(created_at) = date(NOW())", '*');
            if(!empty($task)){
                $today_task = $this->User_model->get_single_record('tbl_task_counter', "user_id = '".$this->session->userdata['user_id']."' and date(created_at) = date(NOW()) and task_id = '".$task_id."'", '*');

                if(empty($today_task)){
                    $TaskCounterIncome = array(
                        'user_id' => $this->session->userdata['user_id'],
                        'task_id' => $task_id,
                    );
                    $this->User_model->add('tbl_task_counter', $TaskCounterIncome);
                    $this->User_model->update('tbl_task', array('id' => $task['id']),array('tasks' => $task['tasks']+ 1));
                    $data['success'] = 1;
                    $data['message'] = 'Task Completed Successfully';
                }else{
                    $data['success'] = 0;
                    $data['message'] = "This Task Already Completed";
                }
            }else{
                $StartTask = array(
                    'user_id' => $this->session->userdata['user_id'],
                    'tasks' => 1,
                    'redeem' => 0,
                );
                $this->User_model->add('tbl_task', $StartTask);
                $data['message'] = 'Task Completed Successfully';
                $data['success'] = 1;
            }
            echo json_encode($data);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function DeleteVideo($video_id){
        if (is_logged_in()) {
            $data['success'] = 0;
            $task = $this->User_model->get_single_record('tbl_user_videos', array('user_id' => $this->session->userdata['user_id'] ,'id' => $video_id), '*');
            if(!empty($task)){
                $res = $this->User_model->delete('tbl_user_videos', array('user_id' => $this->session->userdata['user_id'] ,'id' => $video_id));
                if($res){
                    $data['success'] = 1;
                    $data['message'] = "Video Deleted Successfully";
                }else{
                    $data['success'] = 0;
                    $data['message'] = "you have Already Redeem Your Money";
                }
            }else{
                $data['message'] = 'You Have not Access to Delete this Video';
                $data['success'] = 0;
            }
            echo json_encode($data);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function RedeemMoney(){
        if (is_logged_in()) {
            $data['success'] = 0;
            $task = $this->User_model->get_single_record('tbl_task', "user_id = '".$this->session->userdata['user_id']."' and date(created_at) = date(NOW())", '*');
            if(!empty($task)){
                if($task['redeem'] == 0){
                    if($task['tasks'] >= 15){
                        $this->User_model->update('tbl_task', array('id' => $task['id']),array('redeem' => 1));
                        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
                        $data['success'] = 1;
                        $data['message'] = 'Points Redeemed Successfully';
                        $TaskIncome = array(
                            'user_id' => $user['user_id'],
                            'points' => 5 ,
                            'type' => 'task_income', 
                            'description' => 'Points Redeem',
                        );
                        $this->User_model->add('tbl_points', $TaskIncome);
                        // $this->task_level_income($user['sponser_id'] , $user['user_id']);
                    }else{
                        $data['message'] = 'Still your tasks are Not Completed';
                    }
                }else{
                    $data['success'] = 0;
                    $data['message'] = "you have Already Redeem Your Money";
                }
            }else{
                $data['message'] = 'Your tasks Are Not Completed Today';
                $data['success'] = 0;
            }
            echo json_encode($data);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function task_level_income($sponser_id,$activated_id){
        $incomes = array(10,9,8,7,5,4,3,2,1,0.5,0.25,0.25,0.10,0.10,0.10);
        foreach($incomes as $key => $income){
            $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $sponser_id), 'id,user_id,sponser_id,paid_status');
            if(!empty($sponser)){
                if($sponser['paid_status'] == 1){
                    $LevelIncome = array(
                        'user_id' => $sponser['user_id'],
                        'amount' => $income ,
                        'type' => 'task_level_income', 
                        'description' => 'Task Income from Member '.$activated_id  . ' At level '.($key + 1),
                    );
                    $this->User_model->add('tbl_income_wallet', $LevelIncome);
                }
                $sponser_id = $sponser['sponser_id'];
            }
        }
    }
}
