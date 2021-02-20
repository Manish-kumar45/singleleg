<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Franchise extends CI_Controller {

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
            $config['total_rows'] = $this->Main_model->get_sum('tbl_franchise', $where, 'ifnull(count(id),0) as sum');
            $config['base_url'] = base_url() . 'Admin/Franchise/index';
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
            $response['franchises'] = $this->Main_model->get_limit_records('tbl_franchise', $where, '*', $config['per_page'], $segment);


            $response['segament'] = $segment;
            $response['type'] = $field;
            $response['value'] = $value;
            $response['total_records'] = $config['total_rows'];
            $this->load->view('franchise_list', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function AddFranchise() {
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
                $this->form_validation->set_rules('phone', 'Phone', 'trim|required|xss_clean');
                $this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
                $this->form_validation->set_rules('pin_code', 'Pin Code', 'trim|required|numeric|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $packArr = array(
                        'name' => $data['name'],
                        'phone' => $data['phone'],
                        'address' => $data['address'],
                        'pin_code' => $data['pin_code'],
                    );
                    $res = $this->Main_model->add('tbl_franchise', $packArr);
                    if ($res == TRUE) {
                        $this->session->set_flashdata('message', 'Franchise Added Successfully');
                    } else {
                        $this->session->set_flashdata('message', 'Error While Creating Franchise  Please Try Again ...');
                    }
                }
            }
            $this->load->view('create_franchise', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function Delete($id){
        if (is_admin()) {
            $franchise = $this->Main_model->get_single_record('tbl_franchise', array('id' => $id), '*');
            if(!empty($franchise)){
                $res = $this->Main_model->delete('tbl_franchise',$id);
                if($res){
                    $this->session->set_flashdata('message', 'Franchise Deleted Successfully');
                }else{
                    $this->session->set_flashdata('message', 'Error while Deleting Franchise');
                }
            }else{
                $this->session->set_flashdata('message', 'Invalid Franchise');
            }
            redirect('Admin/Franchise/index');
        } else {
            redirect('Admin/Management/login');
        }
    }
}
