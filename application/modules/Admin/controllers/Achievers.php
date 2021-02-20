<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Achievers extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('Main_model'));
        $this->load->helper(array('admin', 'security'));
    }

    public function index() {
        if (is_admin()) {
            $field = $this->input->get('type');
            $value = $this->input->get('value');
            $where = array($field => $value);
            // pr($where,true);
            if (empty($where[$field]))
                $where = array();
            $config['total_rows'] = $this->Main_model->get_sum('tbl_achievers', $where, 'ifnull(count(id),0) as sum');
            $config['base_url'] = base_url() . 'Admin/Achievers/index';
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
            $response['achievers'] = $this->Main_model->get_limit_records('tbl_achievers', $where, '*', $config['per_page'], $segment);


            $response['segament'] = $segment;
            $response['type'] = $field;
            $response['value'] = $value;
            $response['total_records'] = $config['total_rows'];
            $this->load->view('achievers_list', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function AddAchiever() {
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $params = $this->security->xss_clean($this->input->post());
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'doc|jpeg|jpg|png';
                $config['file_name'] = 'am' . time();
                $this->load->library('upload', $config);
                $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
                $this->form_validation->set_rules('designation', 'Designation', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    if (!$this->upload->do_upload('media')) {
                        $this->session->set_flashdata('message', $this->upload->display_errors());
                    } else {
                        $data = array('upload_data' => $this->upload->data());
                        $promoArr = array(
                            'name' => $params['name'],
                            'designation' => $params['designation'],
                            'image' => $data['upload_data']['file_name'],
                        ); 
                        $res = $this->Main_model->add('tbl_achievers',$promoArr);
                        if ($res) {
                            $this->session->set_flashdata('message', 'Image Update Successfully');
                        } else {
                            $this->session->set_flashdata('message', 'Error While Adding Popup Please Try Again ...');
                        }
                    }
                }                
            }
            $this->load->view('create_achiever', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function Delete($id){
        if (is_admin()) {
            $franchise = $this->Main_model->get_single_record('tbl_achievers', array('id' => $id), '*');
            if(!empty($franchise)){
                $res = $this->Main_model->delete('tbl_achievers',$id);
                if($res){
                    $this->session->set_flashdata('message', 'Achiever Deleted Successfully');
                }else{
                    $this->session->set_flashdata('message', 'Error while Deleting Achiever');
                }
            }else{
                $this->session->set_flashdata('message', 'Invalid Achiever Account');
            }
            redirect('Admin/Achievers/index');
        } else {
            redirect('Admin/Management/login');
        }
    }
}
