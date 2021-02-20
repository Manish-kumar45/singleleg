<?php
dsfkdjhj
defined('BASEPATH') OR exit('No direct script access allowed');

class Package extends CI_Controller {

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

    public function create() {
        if (is_admin()) {
            $response = [];
            $response['products'] = $this->Main_model->get_records('tbl_products', array(), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
                $this->form_validation->set_rules('bv', 'BV', 'trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('description', 'description', 'trim|required|xss_clean');
                $this->form_validation->set_rules('price', 'Price', 'trim|required|xss_clean');
                $this->form_validation->set_rules('commision', 'Commision', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $q = $this->input->post('item_count');
                    $products = $this->input->post('product');
                    foreach ($products as $key => $p) {
                        $product[$key]['id'] = $p;
                        $product[$key]['quantity'] = $q[$key];
                    }
                    $packArr = array(
                        'title' => $data['title'],
                        'description' => $data['description'],
                        'price' => $data['price'],
                        'bv' => $data['bv'],
                        'products' => json_encode($product),
                        'commision' => $data['commision'],
                    );
                    $res = $this->Main_model->add('tbl_package', $packArr);
                    if ($res == TRUE) {
                        $this->session->set_flashdata('message', 'New Package Created Successfully');
                    } else {
                        $this->session->set_flashdata('message', 'Error While Creating New Package Please Try Again ...');
                    }
                }
            }
            $this->load->view('create_package', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function Edit($id) {
        if (is_admin()) {
            $response = [];
            $response['products'] = $this->Main_model->get_records('tbl_products', array(), '*');
            $response['package'] = $this->Main_model->get_single_record('tbl_package', array('id' => $id), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
//                $this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
//                $this->form_validation->set_rules('bv', 'BV', 'trim|required|numeric|xss_clean');
//                $this->form_validation->set_rules('description', 'description', 'trim|required|xss_clean');
//                $this->form_validation->set_rules('price', 'Price', 'trim|required|xss_clean');
//                $this->form_validation->set_rules('commision', 'Commision', 'trim|required|xss_clean');
//                if ($this->form_validation->run() != FALSE) {
//                    pr($data);
//                    $products = implode(',', $data['product']);
                $q = $this->input->post('item_count');
                $products = $this->input->post('product');
                if (empty($product))
                    $product = array();
                else {
                    foreach ($products as $key => $p) {
                        $product[$key]['id'] = $p;
                        $product[$key]['quantity'] = $q[$key];
                    }
                }

                $packArr = array(
                    'title' => $data['title'],
                    'description' => $data['description'],
                    'price' => $data['price'],
                    'bv' => $data['bv'],
                    'products' => json_encode($product),
                    'commision' => $data['commision'],
                );
                $res = $this->Main_model->update('tbl_package', array('id' => $id), $packArr);
                if ($res) {
                    $this->session->set_flashdata('message', 'Package Updated Successfully');
                    $response['package'] = $this->Main_model->get_single_record('tbl_package', array('id' => $id), '*');
                } else {
                    $this->session->set_flashdata('message', 'Error While Updating  Package Please Try Again ...');
                }
//                }else{
//                    echo form_error();
//                    die('we are here');
//                }
            }

            $this->load->view('edit_package', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function upload_package_image() {
        if (is_admin()) {
            $response = array();
            $data = $_POST['image'];
            list($type, $data) = explode(';', $data);
            list(, $data) = explode(',', $data);

            $data = base64_decode($data);
            $imageName = 'pack' . time() . '.png';
            file_put_contents(APPPATH . '../uploads/' . $imageName, $data);
            $imageArray = array(
                'image' => $imageName,
            );
            $package_id = $this->input->post('package_id');
            $updres = $this->Main_model->update('tbl_package', array('id' => $package_id), $imageArray);
            $response['message'] = 'Image uploaed Succesffully';
            echo json_encode($response);
            exit();
        }
    }

    public function Products() {
        if (is_admin()) {
            $response['products'] = $this->Main_model->get_records('tbl_products', array(), '*');
            $this->load->view('products_list', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function CreateProduct() {
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
                $this->form_validation->set_rules('bv', 'BV', 'trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('member_price', 'Member Price', 'trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('retail_price', 'Retail Price', 'trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('description', 'Description', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $data = $this->security->xss_clean($this->input->post());
                    $productArr = array(
                        'title' => $data['title'],
                        'bv' => $data['bv'],
                        'member_price' => $data['member_price'],
                        'retail_price' => $data['retail_price'],
                        'description' => $data['description'],
                    );
                    $res = $this->Main_model->add('tbl_products', $productArr);
                    if ($res) {
                        $this->session->set_flashdata('message', 'New Product Created Successfully');
                        redirect('Admin/Package/EditProduct/' . $res);
                    } else {
                        $this->session->set_flashdata('message', 'Error While Creating New Product   Please Try Again ...');
                    }
                }
            }
            $this->load->view('create_product', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function EditProduct($id) {
        if (is_admin()) {
            $response = array();
            $response['product'] = $this->Main_model->get_single_record('tbl_products', array('id' => $id), '*');
            $response['product_images'] = $this->Main_model->get_records('tbl_product_images', array('product_id' => $id), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
                $this->form_validation->set_rules('bv', 'BV', 'trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('member_price', 'Member Price', 'trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('retail_price', 'Retail Price', 'trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('description', 'description', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $data = $this->security->xss_clean($this->input->post());
                    $productArr = array(
                        'title' => $data['title'],
                        'bv' => $data['bv'],
                        'member_price' => $data['member_price'],
                        'retail_price' => $data['retail_price'],
                        'description' => $data['description'],
                    );
                    $res = $this->Main_model->update('tbl_products', array('id' => $id), $productArr);
                    if ($res) {
                        $this->session->set_flashdata('message', 'Product Updated Successfully');
                    } else {
                        $this->session->set_flashdata('message', 'Error While Updating Product Please Try Again ...');
                    }
                }
            }

            $this->load->view('edit_product', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function upload_product_image() {
        if (is_admin()) {
            $response = array();
            $data = $_POST['image'];
            list($type, $data) = explode(';', $data);
            list(, $data) = explode(',', $data);

            $data = base64_decode($data);
            $imageName = 'prod' . time() . '.png';
            file_put_contents(APPPATH . '../uploads/' . $imageName, $data);
            $imageArray = array(
                'product_id' => $this->input->post('product_id'),
                'image' => $imageName,
            );
            $updres = $this->Main_model->add('tbl_product_images', $imageArray);
            $response['message'] = 'Image uploaed Succesffully';
            echo json_encode($response);
            exit();
        }
    }

    public function DeleteProduct($id) {
        if (is_admin()) {
            $product = $this->Main_model->get_single_record('tbl_products', array('id' => $id), '*');
            if (!empty($product)) {
                $res = $this->Main_model->delete('tbl_products', $id);
                if ($res) {
                    $this->session->set_flashdata('message', 'Product Deleted Successfully');
                } else {
                    $this->session->set_flashdata('message', 'Error While Deleting Product   Please Try Again ...');
                }
            } else {
                $this->session->set_flashdata('message', 'No Product Found');
            }
            redirect('Admin/Package/Products');
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function delete_product_image($product_id, $id) {
        if (is_admin()) {
            $product = $this->Main_model->get_single_record('tbl_product_images', array('id' => $id), '*');
            if (!empty($product)) {
//                PR('file://'.$_SERVER['DOCUMENT_ROOT'].$product['image']);
//                unlink('file://' . $_SERVER['DOCUMENT_ROOT'] . $product['image']);
//                unlink(APPPATH('uploads/' . $product['image']));
                $res = $this->Main_model->delete('tbl_product_images', $id);
                if ($res) {
                    $this->session->set_flashdata('message', 'Product Image Deleted Successfully');
                } else {
                    $this->session->set_flashdata('message', 'Error While Deleting Product image  Please Try Again ...');
                }
            } else {
                $this->session->set_flashdata('message', 'No Image Found');
            }
            redirect('Admin/Package/EditProduct/' . $product_id);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function Tax() {
        if (is_admin()) {
            $response['tax'] = $this->Main_model->get_single_record('tbl_tax', array('id' => 1), '*');
            $this->form_validation->set_rules('tax', 'Tax', 'trim|required|numeric|xss_clean');
            if ($this->form_validation->run() != FALSE) {
                $data = $this->security->xss_clean($this->input->post());
                $res = $this->Main_model->update('tbl_tax', array('id' => 1), array('tax' => $data['tax']));
                if ($res) {
                    $this->session->set_flashdata('message', 'Tax Updated Successfully');
                    $response['tax'] = $this->Main_model->get_single_record('tbl_tax', array('id' => 1), '*');
                } else {
                    $this->session->set_flashdata('message', 'Error While Updating  Tax Please Try Again ...');
                }
            }
            $this->load->view('tax', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

}
