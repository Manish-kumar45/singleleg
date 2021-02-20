<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('Main_model'));
        $this->load->helper(array('admin', 'security'));
    }

    public function index() {
        if (is_admin()) {
            $response = array();
            $response['tasks'] = $this->Main_model->get_records('tbl_task_links', array(), '*');
            $this->load->view('task_list', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function ChannelList() {
        if (is_admin()) {
            $response = array();
            $response['tasks'] = $this->Main_model->get_records('tbl_channel_links', array(), '*');
            $this->load->view('channel_list', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function Create() {
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('link', 'Link', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $tasks = $this->Main_model->get_single_record('tbl_task_links', array(), 'ifnull(count(id),0)  as total_links');
                    if($tasks['total_links'] < 15){
                        $TaskData = array(
                            'link' => $data['link'],
                        );
                        $this->Main_model->add('tbl_task_links', $TaskData);
                        $this->session->set_flashdata('message', 'Task Created Successfully');
                    }else{
                        $this->session->set_flashdata('message', '15 Tasks Already Created');
                    }
                }
            }
            $this->load->view('create_task', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function CreateChannel() {
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('link', 'Link', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $tasks = $this->Main_model->get_single_record('tbl_channel_links', array(), 'ifnull(count(id),0)  as total_links');
                    if($tasks['total_links'] < 15){
                        $TaskData = array(
                            'link' => $data['link'],
                        );
                        $this->Main_model->add('tbl_channel_links', $TaskData);
                        $this->session->set_flashdata('message', 'Channel Created Successfully');
                    }else{
                        $this->session->set_flashdata('message', '15 Channel Already Created');
                    }
                }
            }
            $this->load->view('create_channel', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function Edit($task_id) {
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('link', 'Link', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $updtask =  $updres = $this->Main_model->update('tbl_task_links', array('id' => $task_id), array('link' => $data['link']));
                    if ($updres == true) {
                        $this->session->set_flashdata('message', 'Task Updated Successfully');
                    }else{
                        $this->session->set_flashdata('message', 'Error while Updating Task');
                    }
                }
            }
            $response['task'] = $this->Main_model->get_single_record('tbl_task_links', array('id' => $task_id), '*');
            $this->load->view('edit_task', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function EditChannel($task_id) {
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('link', 'Link', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $updtask =  $updres = $this->Main_model->update('tbl_channel_links', array('id' => $task_id), array('link' => $data['link']));
                    if ($updres == true) {
                        $this->session->set_flashdata('message', 'Task Updated Successfully');
                    }else{
                        $this->session->set_flashdata('message', 'Error while Updating Task');
                    }
                }
            }
            $response['task'] = $this->Main_model->get_single_record('tbl_channel_links', array('id' => $task_id), '*');
            $this->load->view('edit_channel', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function VideoRequest() {
        if (is_admin()) {
            $response = array();
            $response['videos'] = $this->Main_model->get_records('tbl_user_videos', array('status !=' => 1 ), '*');
            foreach($response['videos'] as $key => $video){
                $response['videos'][$key]['user'] =  $this->Main_model->get_single_record('tbl_users', array('user_id' => $video['user_id']), 'name,first_name,last_name,phone,email');
            }
            $this->load->view('video_requests', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function Roi($type) {
        if (is_admin()) {
            $response = array();
            $field = $this->input->get('type');
            $value = $this->input->get('value');
            $where = array($field => $value);
            // pr($where,true);
            if (empty($where[$field]))
                $where = array();

            $where['type'] = $type;
            $response['header'] = str_replace('_' , ' ' ,$type);
            $config['total_rows'] = $this->Main_model->get_sum('tbl_roi', $where, 'ifnull(count(id),0) as sum');
            $config['base_url'] = base_url('Admin/Task/Roi/single_leg/'.$type);
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
            $segment = $this->uri->segment(6);
            $response['segament'] = $segment;
            $response['total_records'] = $config['total_rows'];

            $response['type'] = $field;
            $response['value'] = $value;
            $response['records'] = $this->Main_model->get_limit_records('tbl_roi', $where, '*', $config['per_page'], $segment);
             $this->load->view('roi_records', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function UpdateRoiStatus($id){
        if (is_admin()) {
            $response = array();
            $response['success'] = 0;
            $roi = $this->Main_model->get_single_record('tbl_roi', array('id' => $id), '*');
            if(!empty($roi)){
                $updres = $this->Main_model->update('tbl_roi', array('id' => $id), array('days' => 0));
                if ($updres == true) {
                    $response['message'] = 'Roi Stopped Successfully';
                    $response['success'] = 1;
                }else{
                    $response['message'] = 'Error while Stopping ROI';
                }
            }else{
                $response['message'] = 'Invalid ROI';
            }

            echo json_encode($response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function UpdateVideoStatus($id,$status){
        if (is_admin()) {
            $response = array();
            $response['success'] = 0;
            $video = $this->Main_model->get_single_record('tbl_user_videos', array('id' => $id), '*');
            if(!empty($video)){
                $updres = $this->Main_model->update('tbl_user_videos', array('id' => $id), array('status' => $status));
                if ($updres == true) {
                    $response['message'] = 'Task Updated Successfully';
                    $response['success'] = 1;
                }else{
                    $response['message'] = 'Error while Updating Task';
                }
            }else{
                $response['message'] = 'This Video is not Available';
            }

            echo json_encode($response);
        } else {
            redirect('Admin/Management/login');
        }
    }
}